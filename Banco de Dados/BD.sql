-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema EscalaServico
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema EscalaServico
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `EscalaServico` DEFAULT CHARACTER SET utf8 ;
USE `EscalaServico` ;

-- -----------------------------------------------------
-- Table `EscalaServico`.`Usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `EscalaServico`.`Usuario` ;

CREATE TABLE IF NOT EXISTS `EscalaServico`.`Usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(250) NOT NULL,
  `escala` LONGBLOB NULL,
  `mime` VARCHAR(45) NULL,
  PRIMARY KEY (`idUsuario`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `EscalaServico`.`Usuario`
-- -----------------------------------------------------
START TRANSACTION;
USE `EscalaServico`;
INSERT INTO `EscalaServico`.`Usuario` (`idUsuario`, `login`, `senha`, `escala`, `mime`) VALUES (DEFAULT, 'brigada', '', NULL, NULL);
INSERT INTO `EscalaServico`.`Usuario` (`idUsuario`, `login`, `senha`, `escala`, `mime`) VALUES (DEFAULT, 'oficiais', '', NULL, NULL);
INSERT INTO `EscalaServico`.`Usuario` (`idUsuario`, `login`, `senha`, `escala`, `mime`) VALUES (DEFAULT, 'sargentos', '', NULL, NULL);
INSERT INTO `EscalaServico`.`Usuario` (`idUsuario`, `login`, `senha`, `escala`, `mime`) VALUES (DEFAULT, 'cabos', '', NULL, NULL);

COMMIT;

