<?php
/**
 * PDO db driver for aint framework
 */
namespace aint\db\driver\pdo;

use aint\common;

/**
 * Database Connection parameters
 */
const param_dns = 'dns',
      param_username = 'username',
      param_password = 'password';

/**
 * Fetches all resulting records for a query
 */
function fetch_all(\PDO $pdo_connection, string $query): array|false {
    return query($pdo_connection, $query)->fetchAll();
}

/**
 * Prepares a statement object for a query and returns it
 */
function query(\PDO $pdo_connection, string $query): \PDOStatement {
    $statement = $pdo_connection->prepare($query);
    $statement->execute();
    return $statement;
}

/**
 * Connects to the database and returns the link to the connection established
 */
function db_connect(array $params): \PDO {
    $username = common\get_param($params, param_username);
    $password = common\get_param($params, param_password);
    return new \PDO($params[param_dns], $username, $password);
}
