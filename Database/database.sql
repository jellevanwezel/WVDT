SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `WVDT` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `WVDT` ;

-- -----------------------------------------------------
-- Table `WVDT`.`tbl_user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `WVDT`.`tbl_user` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(64) NOT NULL ,
  `password` VARCHAR(128) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WVDT`.`tbl_product`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `WVDT`.`tbl_product` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(64) NULL ,
  `price` DECIMAL(7,2) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WVDT`.`tbl_product_user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `WVDT`.`tbl_product_user` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `product_id` INT NOT NULL ,
  `amount` INT NOT NULL DEFAULT 1 ,
  `amount_scanned` INT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_user_id_idx` (`user_id` ASC) ,
  INDEX `FK_product_id_idx` (`product_id` ASC) ,
  CONSTRAINT `FK_user_id`
    FOREIGN KEY (`user_id` )
    REFERENCES `WVDT`.`tbl_user` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_product_id`
    FOREIGN KEY (`product_id` )
    REFERENCES `WVDT`.`tbl_product` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WVDT`.`tbl_payment`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `WVDT`.`tbl_payment` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `payed` TINYINT(1) NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_user_id_idx` (`user_id` ASC) ,
  CONSTRAINT `FK_user_id`
    FOREIGN KEY (`user_id` )
    REFERENCES `WVDT`.`tbl_user` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `WVDT`.`tbl_product_payment`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `WVDT`.`tbl_product_payment` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `payment_id` INT NOT NULL ,
  `product_id` INT NOT NULL ,
  `amount` INT NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) ,
  INDEX `FK_payment_id_idx` (`payment_id` ASC) ,
  INDEX `FK_product_id_idx` (`product_id` ASC) ,
  CONSTRAINT `FK_payment_id`
    FOREIGN KEY (`payment_id` )
    REFERENCES `WVDT`.`tbl_payment` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_product_id`
    FOREIGN KEY (`product_id` )
    REFERENCES `WVDT`.`tbl_product` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

USE `WVDT` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
