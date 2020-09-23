

-- Create database

CREATE DATABASE wrenTest;

-- and use...

USE wrenTest;

-- Create table for data

CREATE TABLE tblProductData (
  intProductDataId int(10) unsigned NOT NULL AUTO_INCREMENT,
  strProductName varchar(50) NOT NULL,
  strProductDesc varchar(255) NOT NULL,
  strProductCode varchar(10) NOT NULL,
  dtmAdded datetime DEFAULT NULL,
  dtmDiscontinued datetime DEFAULT NULL,
  stmTimestamp timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (intProductDataId),
  UNIQUE KEY (strProductCode)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Stores product data';

-- Adds intStock column
ALTER TABLE tblProductData ADD intStock int(10) NOT NULL;

-- Adds dcmPrice column
ALTER TABLE tblProductData ADD dcmPrice decimal(15, 2) NOT NULL;
