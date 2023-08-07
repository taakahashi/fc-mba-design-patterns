<?php

$db = new SQLite3('database.sqlite', SQLITE3_OPEN_READWRITE, '');

$db->exec("DROP TABLE IF EXISTS contract;");
$db->exec("DROP TABLE IF EXISTS payment;");

$db->exec("CREATE TABLE contract (
    id_contract UUID PRIMARY KEY,
    description TEXT,
    amount NUMERIC,
    periods INTEGER,
    date TIMESTAMP);");

$db->exec("CREATE TABLE payment (
    id_payment UUID PRIMARY KEY,
    id_contract UUID,
    amount NUMERIC,
    date TIMESTAMP,
    FOREIGN KEY (id_contract) REFERENCES contract (id_contract));");

$db->exec("INSERT INTO contract VALUES ('fe407d85-00b1-490c-82db-8ffd471f42dd', 'Prestação de serviços escolares', 6000, 12, '2023-01-01T10:00:00')");
$db->exec("INSERT INTO payment VALUES ('01cb1f69-471b-4de7-8485-cd2a1a07e5c1', 'fe407d85-00b1-490c-82db-8ffd471f42dd', 6000, '2023-01-01T10:00:00')");

$db->close();
