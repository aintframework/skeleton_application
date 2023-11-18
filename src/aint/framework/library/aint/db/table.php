<?php
/**
 * Implementation of Table Gateway Pattern
 */
namespace aint\db\table;

use aint\db\sql;

/**
 * Prepares and executes a select query on the table specified.
 */
function select(\PDO $db_connection, string $platform_namespace, string $driver_namespace, string $table, array $where = []): array|false {
    $select = sql\prepare_select($platform_namespace, '*', $table);
    $where = sql\prepare_where($platform_namespace, $where);
    $fetch_all = $driver_namespace . '\fetch_all';
    return $fetch_all($db_connection, implode(' ', [$select, $where]));
}

/**
 * Prepares and executes an insert on the table specified.
 * The data for the new record is presented as a key => value array
 */
function insert(\PDO $db_connection, string $platform_namespace, string $driver_namespace, string $table, array $data): \PDOStatement {
    /** @var \PDOStatement $query */
    $query = $driver_namespace . '\query';
    return $query($db_connection, sql\prepare_insert($platform_namespace, $table, $data));
}

/**
 * Prepares and executes an update on the table specified.
 * The data for the update is presented as a key => value array
 * WHERE part is an array of constraints all of which must qualify
 */
function update(\PDO $db_connection, string $platform_namespace, string $driver_namespace, string $table, array $data, array $where = []): \PDOStatement {
    $update = sql\prepare_update($platform_namespace, $table, $data);
    $where = sql\prepare_where($platform_namespace, $where);
    /** @var \PDOStatement $query */
    $query = $driver_namespace . '\query';
    return $query($db_connection, implode(' ', [$update, $where]));
}

/**
 * Prepares and executes a delete on the table specified.
 * WHERE part is an array of constraints all of which must qualify
 */
function delete(\PDO $db_connection, string $platform_namespace, string $driver_namespace, string $table, array $where = []): \PDOStatement {
    $delete = sql\prepare_delete($platform_namespace, $table);
    $where = sql\prepare_where($platform_namespace, $where);
    /** @var \PDOStatement $query */
    $query = $driver_namespace . '\query';
    return $query($db_connection, implode(' ', [$delete, $where]));
}

