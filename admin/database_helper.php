<?php

function db_execute($conn, string $sql, string $types = '', array $params = [])
{
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        return false;
    }

    if ($types !== '') {
        $bindParams = [$stmt, $types];

        foreach ($params as $index => &$param) {
            $bindParams[] = &$param;
        }

        if (!call_user_func_array('mysqli_stmt_bind_param', $bindParams)) {
            mysqli_stmt_close($stmt);
            return false;
        }
    }

    if (!mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        return false;
    }

    mysqli_stmt_close($stmt);
    return true;
}

function db_fetch_one($conn, string $sql, string $types = '', array $params = [])
{
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        return null;
    }

    if ($types !== '') {
        $bindParams = [$stmt, $types];

        foreach ($params as $index => &$param) {
            $bindParams[] = &$param;
        }

        if (!call_user_func_array('mysqli_stmt_bind_param', $bindParams)) {
            mysqli_stmt_close($stmt);
            return null;
        }
    }

    if (!mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        return null;
    }

    $result = mysqli_stmt_get_result($stmt);
    $row = $result ? mysqli_fetch_assoc($result) : null;

    if ($result) {
        mysqli_free_result($result);
    }

    mysqli_stmt_close($stmt);
    return $row ?: null;
}
