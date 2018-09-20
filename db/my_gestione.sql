DROP DATABASE IF EXISTS my_gestione;
CREATE DATABASE IF NOT EXISTS my_gestione DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;
USE my_gestione;


CREATE TABLE t_rapportoVVF (
  ID 		                    BIGINT				NOT NULL 	AUTO_INCREMENT,
  ID_Rapporto               BIGINT				NOT NULL,
  OraUscita                 TIMESTAMP,
  OraRientro                TIMESTAMP,
  Data                      DATE,
  Urgente                   BOOLEAN,
  OperazioneEseguite        TEXT,
  Osservazioni              TEXT,
  FK_Localita               BIGINT,
  FK_GeneralitaColpito      BIGINT,
  FK_ProvChiamata           BIGINT,
  FK_TipoChiamata           BIGINT,
  FK_SoccorsiEsterni        BIGINT,
  FK_Responsabile           BIGINT				NOT NULL,
  FK_Compilatore            BIGINT				NOT NULL,
  PRIMARY KEY(ID),
  FOREIGN KEY(FK_Localita)    REFERENCES t_localita(ID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  FOREIGN KEY(FK_GeneralitaColpito)    REFERENCES t_generalitaColpiti(ID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  FOREIGN KEY(FK_ProvChiamata)    REFERENCES t_provChiamata(ID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  FOREIGN KEY(FK_TipoChiamata)    REFERENCES t_tipoChiamata(ID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  FOREIGN KEY(FK_AltriSoccorsi)    REFERENCES t_soccorsiEsterni(ID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  FOREIGN KEY(FK_Responsabile)    REFERENCES t_vigili(ID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  FOREIGN KEY(FK_Compilatore)    REFERENCES t_vigili(ID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;


CREATE TABLE t_vigili (
  ID 		           BIGINT				NOT NULL 	AUTO_INCREMENT,
  Nome	 			     VARCHAR(50),
  Cognome			     VARCHAR(50),
  Matricola		     VARCHAR(3)	UNIQUE NOT NULL,
  PRIMARY KEY(ID)
) ENGINE = InnoDB;

CREATE TABLE t_localita (
  ID 		           BIGINT				NOT NULL 	AUTO_INCREMENT,
  Via              VARCHAR(50),
  Comune           VARCHAR(50),
  PRIMARY KEY(ID)
) ENGINE = InnoDB;

CREATE TABLE t_provChiamata (
  ID 		           BIGINT				NOT NULL 	AUTO_INCREMENT,
  Provenienza      VARCHAR(50),
  PRIMARY KEY(ID)
) ENGINE = InnoDB;

CREATE TABLE t_tipoChiamata (
  ID 		           BIGINT				NOT NULL 	AUTO_INCREMENT,
  Tipologia        VARCHAR(50),
  PRIMARY KEY(ID)
) ENGINE = InnoDB;

CREATE TABLE t_mezzi (
  ID 		           BIGINT				NOT NULL 	AUTO_INCREMENT,
  Descrizione      VARCHAR(50),
  PRIMARY KEY(ID)
) ENGINE = InnoDB;

CREATE TABLE t_mezziIntervenuti (
  ID 		            BIGINT				NOT NULL 	AUTO_INCREMENT,
  FK_RapportoVVF    BIGINT,
  FK_Mezzo          BIGINT,
  PRIMARY KEY(ID),
  FOREIGN KEY(FK_RapportoVVF)    REFERENCES t_rapportoVVF(ID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  FOREIGN KEY(FK_Mezzo)    REFERENCES t_mezzi(ID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;

CREATE TABLE t_generalitaColpiti (
  ID 		           BIGINT				NOT NULL 	AUTO_INCREMENT,
  Nome	 			     VARCHAR(50),
  Cognome			     VARCHAR(50),
  DataDiNascita    Date,
  Residenza        VARCHAR(50),
  Telefono         BIGINT,
  NCartaIdentita   BIGINT,
  Altro            VARCHAR(100),
  PRIMARY KEY(ID)
) ENGINE = InnoDB;

CREATE TABLE t_soccorsiEsterni (
  ID 		           BIGINT				NOT NULL 	AUTO_INCREMENT,
  Descrizione      VARCHAR(50),
  PRIMARY KEY(ID)
) ENGINE = InnoDB;

CREATE TABLE t_soccorsiIntervenuti (
  ID 		              BIGINT				NOT NULL 	AUTO_INCREMENT,
  FK_RapportoVVF      BIGINT,
  FK_SoccorsiEsterni  BIGINT,
  PRIMARY KEY(ID),
  FOREIGN KEY(FK_RapportoVVF)    REFERENCES t_rapportoVVF(ID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  FOREIGN KEY(FK_SoccorsiEsterni)    REFERENCES t_soccorsiEsterni(ID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;
