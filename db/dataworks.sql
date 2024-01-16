-- MySQL Script generated by MySQL Workbench
-- Tue Jan 16 10:52:49 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`autos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`autos` (
  `ID` INT NOT NULL,
  `merk` VARCHAR(45) NULL,
  `model` VARCHAR(45) NULL,
  `jaar` INT NULL,
  `kenteken` VARCHAR(45) NULL,
  `beschikbaarheid` TINYINT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`verhuringen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`verhuringen` (
  `ID-verhuring` INT NOT NULL,
  `autos_ID` INT NOT NULL,
  `verhuurdatum` DATE NULL,
  `huurperiode-tot` DATE NULL,
  `kosten` FLOAT NULL,
  PRIMARY KEY (`ID-verhuring`),
  INDEX `fk_verhuringen_autos_idx` (`autos_ID` ASC) VISIBLE,
  CONSTRAINT `fk_verhuringen_autos`
    FOREIGN KEY (`autos_ID`)
    REFERENCES `mydb`.`autos` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`klanten`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`klanten` (
  `ID` INT NOT NULL,
  `naam` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `wachtwoord` VARCHAR(45) NULL,
  `adres` VARCHAR(255) NULL,
  `rijbewijsnummer` VARCHAR(45) NULL,
  `telefoonnummer` VARCHAR(45) NULL,
  `autos_ID` INT NOT NULL,
  `verhuringen_ID-verhuring` INT NOT NULL,
  PRIMARY KEY (`ID`),
  INDEX `fk_klanten_autos1_idx` (`autos_ID` ASC) VISIBLE,
  INDEX `fk_klanten_verhuringen1_idx` (`verhuringen_ID-verhuring` ASC) VISIBLE,
  CONSTRAINT `fk_klanten_autos1`
    FOREIGN KEY (`autos_ID`)
    REFERENCES `mydb`.`autos` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_klanten_verhuringen1`
    FOREIGN KEY (`verhuringen_ID-verhuring`)
    REFERENCES `mydb`.`verhuringen` (`ID-verhuring`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`admin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`admin` (
  `id` INT NOT NULL,
  `naam` VARCHAR(45) NULL,
  `wachtwoord` VARCHAR(45) NULL,
  `autos_ID` INT NOT NULL,
  `verhuringen_ID-verhuring` INT NOT NULL,
  `klanten_ID` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_admin_autos1_idx` (`autos_ID` ASC) VISIBLE,
  INDEX `fk_admin_verhuringen1_idx` (`verhuringen_ID-verhuring` ASC) VISIBLE,
  INDEX `fk_admin_klanten1_idx` (`klanten_ID` ASC) VISIBLE,
  CONSTRAINT `fk_admin_autos1`
    FOREIGN KEY (`autos_ID`)
    REFERENCES `mydb`.`autos` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_admin_verhuringen1`
    FOREIGN KEY (`verhuringen_ID-verhuring`)
    REFERENCES `mydb`.`verhuringen` (`ID-verhuring`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_admin_klanten1`
    FOREIGN KEY (`klanten_ID`)
    REFERENCES `mydb`.`klanten` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
