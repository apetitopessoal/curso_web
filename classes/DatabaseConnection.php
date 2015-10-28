<?php

/*
 * The contents of this file are under the BSD licence
 * Copyright 2010
 * Berry Octave
 */

/**
    \brief A class that allow to manage database connections away from implemenetations problems.
    The aim of that class is to manage a database connection away from implementation problems linked
    to PDO present or not.
    It also provides security functionnality related to sql injections and xss holes.
    \note ANY sql statement must at least be secured for sql injection.
        ANY insert statement must be secured for xss before insertion.
    \author Berry Octave
    Copyright 2010
    This class is under the BSD licence
*/
class DatabaseConnection
{
    /// Global database link
	private $link;
    private $filterLatin1;

    private $preparedStatement = null;
    private $arrayOfSubstitutions = array();

    // Mysql doesn't support multiple statements wherhas mysqli does.
    private $legacyBackendMysqli = true;

    /**
    \brief Construct a database connection
    \note The connection will use an utf8 charset.
    \param host Hostname
    \param user Username
    \param pass Password
    \param dbname Database name
    \param driver Database driver to use

    \note In case of the mysql driver, the aim of this api is to emulate PDO
        using mysql_* and mysqli forms of query (can be configured by editing $legacyBackendMysqli
        in this class declaration (true uses mysqli, false uses mysql_*)).

    */
	function __construct($host, $user, $pass, $dbname, $driver = 'mysql')
	{
        // PDO code
		if (DatabaseConnection::handlesPDO())
        {
            $dsn = $driver.':dbname='.$dbname.';host='.$host.';charset=UTF-8';
            try
            {
                $this->link = new PDO($dsn, $user, $pass);
                // The mysql driver ignores the charset directive in $dsn (yeah, that sucks)
                if ($driver == 'mysql')
                    $this->link->exec("set names utf8");
            }
            catch (PDOException $e)
            {
                die($e->getMessage());
            }
            // We don't need manual conversion.
            $this->filterLatin1 = false;
        }
		else
        {
            if ($driver != 'mysql')
                die ('Error : database driver '.$driver.' is unsupported');

            if ($this->legacyBackendMysqli)
            {
                // mysqli_* code
                $this->link = new mysqli($host, $user, $pass, $dbname);
                if (mysqli_connect_error())
                    die ('Connect error : '.mysqli_connect_errno().') '.mysqli_connect_error());
                // Don't seems to do anything.
                //$this->link->set_charset('UTF-8');
                // $this->link->connect_error is broken for php < 5.2.9 ...
                //die('mysqli connect error '.$this->link->connect_errno.') '.$this->link->connect_error);

                // mysqli_* support for UTF-8 seems to suck a little bit.
                // Therefore, we use the query 'set names utf8'
                $this->filterLatin1 = false;
                $this->link->query('set names utf8');
            }
            else
            {
                // mysql_* code
                $this->link = mysql_connect($host, $user, $pass);
                if ($this->link === false)
                    die(mysql_error($this->link));
                if (mysql_select_db($dbname, $this->link) != true)
                    die(mysql_error($this->link));

                // mysql_* doesn't handle charset, so do conversion by ourselves.
                // Therefore, we use the query 'set names utf8'
                $this->filterLatin1 = false;
                mysql_query('set names utf8', $this->link);
            }
        }
	}

    /**
    \brief Closes the connection
    */
	function __destruct()
	{
        // PDO is fine, this is an object so it's closed on destruct
        if (!DatabaseConnection::handlesPDO())
        {
            if ($this->legacyBackendMysqli)
                // Not sure that mysqli_* is closed on destruct.
                $this->link->close();
            else
                mysql_close($this->link);
        }
	}

    /**
    \brief Returns details implementation
    \returns true if PDO is supported (and used), else returns false
    */
    function handlesPDO()
    {
        return phpversion('pdo') !== false;
//         return false; // For debug
    }


    /**
    \brief Used to display the error triggered by a previously made request.
    \param $statement The statement that raised the error
    \return This method never returns
    */
    function dieError($statement = "")
    {
        if ($this->handlesPDO())
        {
            echo "Query (engine : PDO) : ".$this->filterForXss($statement)."<br />";
            print_r($this->link->errorInfo());
            die("<br />Erreur de requête");
        }
        else
        {
            if ($this->legacyBackendMysqli)
            {
                echo "Query (engine : mysqli legacy) : ".$this->filterForXss($statement)."<br />";
                echo 'Error : '.$this->link->errno.' : '.$this->link->error.'<br />';
                die("<br />Erreur de requête");
            }
            else
            {
                echo "Query (engine : mysql legacy) : ".$this->filterForXss($statement)."<br />";
                die(mysql_error($this->link));
            }
        }
    }

// For debuging only
//     function getLink()
//     {
//         return $this->link;
//     }

    /**
    \brief Translates the given array to utf8
    \param $statement Array of text data that should be translated in UTF-8
    \see fromUtf8
    */
    function toUtf8($array)
    {
        if ($this->filterLatin1)
        {
            // Obnoxious, I know, but this generates a nonsense warning (because that actually works !!)
            // Why not using @, because this is supplied in the docs (foreach doesn't handles @)
            error_reporting(E_ALL & ~E_WARNING);
            foreach ($array as &$v)
            {
                $v = utf8_encode($v);
            }
            error_reporting(E_ALL);
        }
        return $array;
    }

    /**
    \brief Translates the given statement back to latin1
    \param $statement Statement to be translated to latin1 for insertion in database.
    \see toUtf8
    Should be used for any request just because elsewhere, the UTF-8 special chars are lost.
    */
    function fromUtf8($statement)
    {
        if ($this->filterLatin1)
            return utf8_decode($statement);
        else
            return $statement;
    }

    /**
    \brief Pass into transaction mode
    \note Not available if using mysql_* interface, but fine with mysqli_*
        When issuing an sql error in transaction mode, this is safe because the transaction will be rollbacked
        at the object destruction.
    */
    function beginTransaction()
    {
        if (DatabaseConnection::handlesPDO())
            $this->link->beginTransaction();
        //else // Transaction in mysql_* ? nah …
        else
            if ($this->legacyBackendMysqli)
                $this->link->autocommit(false);
    }

    /**
    \brief Commits the started transaction
    \note Not available if using mysql_* interface, fine with mysqli_*
    */
    function commit()
    {
        if (DatabaseConnection::handlesPDO())
            $this->link->commit();
        // Private joke : Don't forget to commit sucide, elsewhere you gonna be punched by a rollback and go to psychatry
        // freenode.net#csharp (maybe)
        else
            if ($this->legacyBackendMysqli)
                $this->link->commit();
    }

    /**
    \brief Rollbacks the started transaction
    \note Not available if using mysql_* interface, fine with mysqli_*
    */
    function rollback()
    {
        if (DatabaseConnection::handlesPDO())
            $this->link->rollback();
        else
            if ($this->legacyBackendMysqli)
                $this->link->rollback();
    }

    /**
    \brief Prepares a statement.
    \param $statement The sql statement with parametters.
    The :param and ? forms of the parametters are allowed.
    If using the PDO interface, prepared statements are natively handled.

    However, if the interface uses the legacy mysql_* api,
    there's no such kind of possibility, and this interface
    has to emulate it (using obnoxious str_replace).
    Anyway, the mysqli_* interface offers only a strange support for
    ? form, so I emulate it too.

    Only one statement can be prepared at a time.

    Parametters doesn't need to be passed to filterForSql (unless
    specified otherwises).
    \see bindValue
    */
    function prepareStatement($statement)
    {
        if ($this->handlesPDO())
        {
            $this->preparedStatement = $this->link->prepare($statement);
        }
        else
        {
            $this->preparedStatement = $statement;
        }
    }

    /**
    \brief Binds a value to a prepared statement
    \param $parametter The parametter name (in the :param form) or the parametter index (in ? form).
    \param $value Value to bind in place of it.
    \param $protect If using the legacy api, protect the parametter against
        sql injections (should be used to be portable with and without pdo).
    \returns true if success (parametter match something), false elsewhere.
    \see prepareStatement
    */
    function bindValue($parametter, $value, $protect = true)
    {
        if ($this->preparedStatement === null)
            return false;
        if ($this->handlesPDO())
        {
            return $this->preparedStatement->bindValue($parametter, $value);
        }
        else
        {
            if ($protect)
                $value = $this->filterForSql($value);

            $value = "'".$value."'";

            if (!is_numeric($parametter))
            {
                if (count(explode($parametter, $this->preparedStatement, 2)) == 2)
                {
                    $this->arrayOfSubstitutions[$parametter] = $value;
                    return true;
                }
                else
                    return false;
            }
            else
            {
                if ($parametter < count(explode("?", $this->preparedStatement)))
                {
                    $this->arrayOfSubstitutions[$parametter] = $value;
                    return true;
                }
                else
                    return false;
            }
        }
    }

    /**
    \brief Executes the prepared statement
    You can pass an optional parametter containing a hash of :param or indexes as key
    and their associated value as value.
    \param $arrayOfParametters An optional array of parametters
    \returns A result handler on success, false elsewhere.
    */
    function executeStatement($arrayOfParametters = null)
    {
        if ($this->preparedStatement === null)
            return false;
        if ($this->handlesPDO())
        {
            $result = null;
            if (is_array($arrayOfParametters))
                $result = $this->preparedStatement->execute($arrayOfParametters);
            else
                $result = $this->preparedStatement->execute();

            if ($result !== false)
            {
                $ret = $this->preparedStatement;
                $this->preparedStatement = null;
                return $ret;
            }
            else
            {
                echo "Prepared query : ".$this->filterForXss($this->preparedStatement->queryString)."<br />";
                print_r($this->link->errorInfo());
                die("<br />Erreur de requête");
                return false;
            }
        }
        else
        {
            if (is_array($arrayOfParametters))
                foreach ($arrayOfSubstitutions as $key => $val)
                    if (!$this->bindValue($key, $val))
                        die("Error, param ".$key." doesn't exists<br />");

            // Reverse sort (for substitutions of ? in reverse order).
            krsort($this->arrayOfSubstitutions);

            // Disallow mixing :param and ? form.
            $form = 0;
            foreach ($this->arrayOfSubstitutions as $key => $value)
            {
            // The ? form.
                if (is_numeric($key))
                {
                    if ($form == 2)
                        die("Error : mixed ? and :param parametters");
                    $form = 1;
                    // Let's do some heavy tricks
                    $exploded = explode("?", $this->preparedStatement, $key + 1);
                    $base = implode("?", array_slice($exploded, 0, $key));
                    $base .= $value;
                    $base .= $exploded[$key];
                    $this->preparedStatement = $base;
                }
                else
                {
                    if ($form == 1)
                        die("Error : mixed ? and :param parametters");
                    $form = 2;
                    $this->preparedStatement = str_replace($key, $value, $this->preparedStatement);
                }
            }
//             echo "Will perform query :", $this->preparedStatement, "<br />";
            return $this->query($this->preparedStatement);
        }
    }


    /**
    \brief Execute an sql statement
    \param $statement An sql statement that should be secured
    \see filterForSql
    \returns A result handler that should be acceded with this object's methods
    */
	function exec($statement)
	{
        if (DatabaseConnection::handlesPDO())
        {
            $result = $this->link->query($this->fromUtf8($statement));
            if ($result === false)
                $this->dieError($statement);

            return $result;
        }
        else
        {
            if ($this->legacyBackendMysqli)
            {
                // Perform a multi_query needs a special api call (...)
                if (substr_count($statement, ';') > 1)
                {
                    // Don't do the translation toUtf8, the file is already encoded.
                    $ret = $this->link->multi_query($statement);
                    // Error returned in $ret is only for the first statement,
                    // loop over them to find the errors.
                    // next_result will return false on error or end.
                    while ($this->link->next_result());
                    if ($this->link->errno)
                            $this->dieError();

                    return $ret;
                }
                else
                {
                    $result = $this->link->query($this->fromUtf8($statement));
                    if ($result === false)
                        $this->dieError($statement);

                    return $result;
                }
            }
            else
            {
                $result = mysql_query($this->fromUtf8($statement), $this->link);
                if ($result === false)
                    $this->dieError($statement);

                return $result;
            }
        }
	}

    /**
    \brief An alias to exec
    \see exec
    */
    function query($statement)
    {
        return $this->exec($statement);
    }



    /**
    \brief Get a row's values
    \return A named hash containing the values of a row
    */
    function fetchAssoc($result)
    {
        if (DatabaseConnection::handlesPDO())
        {
            return $this->toUtf8($result->fetch(PDO::FETCH_ASSOC));
        }
        else
        {
            if ($this->legacyBackendMysqli)
                return $this->toUtf8($result->fetch_assoc());
            else
                return $this->toUtf8(mysql_fetch_assoc($result));
        }
    }

    /**
    \brief Get a row's values
    \returns A named and numbered hash containing the values of a row
    \note For performance reason, this function should be used only when strictly needed, see fetchAssoc or fetchRow
    \see fetchAssoc
    \see fetchRow
    */
    function fetchArray($result)
    {
        if (DatabaseConnection::handlesPDO())
        {
            return $this->toUtf8($result->fetch());
        }
        else
        {
            if ($this->legacyBackendMysqli)
                return $this->toUtf8($result->fetch_array());
            else
                return $this->toUtf8(mysql_fetch_array($result));
        }
    }

    /**
    \brief Get a row's values
    \returns A numbered hash containing the values of a row
    */
    function fetchRow($result)
    {
        if (DatabaseConnection::handlesPDO())
        {
            return $this->toUtf8($result->fetch(PDO::FETCH_NUM));
        }
        else
        {
            if ($this->legacyBackendMysqli)
                return $this->toUtf8($result->fetch_row());
            else
                return $this->toUtf8(mysql_fetch_row($result));
        }
    }

    /**
    \brief Get the number of row in the resultset
    \returns The number of rows associated with this resultset
    */
    function numRows($result)
    {
        if (DatabaseConnection::handlesPDO())
            return $result->rowCount();
        else
        {
            if ($this->legacyBackendMysqli)
                return $this->toUtf8($result->num_rows);
            else
                return mysql_num_rows($result);
        }
    }

    /**
    \brief Returns the last insert id
    */
    function lastInsertId()
    {
        if (DatabaseConnection::handlesPDO())
            return $this->link->lastInsertId();
        else
        {
            if ($this->legacyBackendMysqli)
                return $this->link->insert_id;
            else
                return mysql_insert_id($this->link);
        }
    }

    /// \brief Filter a value for assignment in an sql statement
    /// \note Non suitable for a display usage (html isn't escaped)
    ///    use it if you want to query data from a database.
	function filterForSql($unsafeStatement)
	{
        if (DatabaseConnection::handlesPDO())
            if (get_magic_quotes_gpc())
                return $unsafeStatement;
            else
                return filter_var($unsafeStatement, FILTER_SANITIZE_MAGIC_QUOTES);
//                 return $this->link->quote($unsafeStatement);
        else
            if (get_magic_quotes_gpc())
                return $unsafeStatement; // Let's assume so
            //(because mysql_real_escape_string don't do any check, and mysql is fine with \')
            else
            {
                if ($this->legacyBackendMysqli)
                    return $this->link->escape_string($unsafeStatement);
                else
                    return mysql_real_escape_string($unsafeStatement, $this->link);
            }
	}

    /// \brief Filter a value for display
    /// \note Can be suitable for sql just because the ' and " are escaped.
    ///   The html is just removed.
    ///   use it if you want to store data that could be shown again.
    function filterForXss($unsafeStatement)
    {
        if (phpversion() >= "5.2.0")
            return filter_var($unsafeStatement, FILTER_SANITIZE_STRING);
        else
            return htmlentities(strip_tags($unsafeStatement));
    }
}

?>