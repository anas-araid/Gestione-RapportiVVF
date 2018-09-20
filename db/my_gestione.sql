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

INSERT INTO t_provChiamata VALUES ('Selettiva Centrale Trento');
INSERT INTO t_provChiamata VALUES ('Telefono Centrale Trento');
INSERT INTO t_provChiamata VALUES ('Radio Centrale Trento');
INSERT INTO t_provChiamata VALUES ('Selettiva Corpo');
INSERT INTO t_provChiamata VALUES ('Comandante');
INSERT INTO t_provChiamata VALUES ('Vicecomandante');
INSERT INTO t_provChiamata VALUES ('Passante');
INSERT INTO t_provChiamata VALUES ('Telefono');
INSERT INTO t_provChiamata VALUES ('Servizi');
INSERT INTO t_provChiamata VALUES ('Altro');

INSERT INTO t_mezzi VALUES ('VW Interventi Tecnici');
INSERT INTO t_mezzi VALUES ('VW Pinze');
INSERT INTO t_mezzi VALUES ('Daily Interventi Tecnici');
INSERT INTO t_mezzi VALUES ('Autobotte Volvo');
INSERT INTO t_mezzi VALUES ('Autobotte 180');
INSERT INTO t_mezzi VALUES ('Minibotte');
INSERT INTO t_mezzi VALUES ('Autoscala');
INSERT INTO t_mezzi VALUES ('Snorkel');
INSERT INTO t_mezzi VALUES ('Autogru MAN');
INSERT INTO t_mezzi VALUES ('Nissan Terrano');
INSERT INTO t_mezzi VALUES ('Land Rover TD5');
INSERT INTO t_mezzi VALUES ('Land Rover TD4');
INSERT INTO t_mezzi VALUES ('Mitsubishi Pickup');
INSERT INTO t_mezzi VALUES ('Gommone');
INSERT INTO t_mezzi VALUES ('Fiat Punto');
INSERT INTO t_mezzi VALUES ('Daily Trasporto');
INSERT INTO t_mezzi VALUES ('VW trasp. persone');
INSERT INTO t_mezzi VALUES ('VW trasp. unione');
INSERT INTO t_mezzi VALUES ('Carrello trasporto mezzi');
INSERT INTO t_mezzi VALUES ('Pompa Ziegler');
INSERT INTO t_mezzi VALUES ('Carrello Ziegler');
INSERT INTO t_mezzi VALUES ('Carrello incendi boschivi');
INSERT INTO t_mezzi VALUES ('Pompa Rosenbauer');
INSERT INTO t_mezzi VALUES ('Carrello gruppo elettrogeno');
INSERT INTO t_mezzi VALUES ('Idrovora');

INSERT INTO t_soccorsiEsterni VALUES ('CC Pergine');
INSERT INTO t_soccorsiEsterni VALUES ('CC Borgo');
INSERT INTO t_soccorsiEsterni VALUES ('Polizia Municipale');
INSERT INTO t_soccorsiEsterni VALUES ('Polizia Stradale');
INSERT INTO t_soccorsiEsterni VALUES ('Medico');
INSERT INTO t_soccorsiEsterni VALUES ('Ambulanza');
INSERT INTO t_soccorsiEsterni VALUES ('Gestione Strade');
INSERT INTO t_soccorsiEsterni VALUES ('Servizi forestali');
INSERT INTO t_soccorsiEsterni VALUES ('AMNU-Serv. fun.');
INSERT INTO t_soccorsiEsterni VALUES ('CSA');

INSERT INTO t_tipoChiamata VALUES ('Allagamento');
INSERT INTO t_tipoChiamata VALUES ('Apertura porta');
INSERT INTO t_tipoChiamata VALUES ('Bonifica insetti');
INSERT INTO t_tipoChiamata VALUES ('Fuga di gas');
INSERT INTO t_tipoChiamata VALUES ('Incendio abitazione');
INSERT INTO t_tipoChiamata VALUES ('Incendio autoveicolo');
INSERT INTO t_tipoChiamata VALUES ('Incendio sterpaglie');
INSERT INTO t_tipoChiamata VALUES ('Incendio cassonetto');
INSERT INTO t_tipoChiamata VALUES ('Altri incendi');
INSERT INTO t_tipoChiamata VALUES ('Incidente stradale');
INSERT INTO t_tipoChiamata VALUES ('Inquinamento');
INSERT INTO t_tipoChiamata VALUES ('Manifestazioni');
INSERT INTO t_tipoChiamata VALUES ('Prevenzione');
INSERT INTO t_tipoChiamata VALUES ('Pulizia sede stradale');
INSERT INTO t_tipoChiamata VALUES ('Recupero carico');
INSERT INTO t_tipoChiamata VALUES ('Sblocco ascensore');
INSERT INTO t_tipoChiamata VALUES ('Servizio reperibilità');
INSERT INTO t_tipoChiamata VALUES ('Soccorso animali');
INSERT INTO t_tipoChiamata VALUES ('Soccorso persona');
INSERT INTO t_tipoChiamata VALUES ('Soccorso tecnico generico');
INSERT INTO t_tipoChiamata VALUES ('Sopralluogo incendio');
INSERT INTO t_tipoChiamata VALUES ('Supporto elicottero');
INSERT INTO t_tipoChiamata VALUES ('Taglio Pianta');
INSERT INTO t_tipoChiamata VALUES ('Altro');
