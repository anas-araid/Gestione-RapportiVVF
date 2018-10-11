DROP DATABASE IF EXISTS my_gestione;
CREATE DATABASE IF NOT EXISTS my_gestione DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;
USE my_gestione;

CREATE TABLE t_vigili (
  ID 		           BIGINT				NOT NULL 	AUTO_INCREMENT,
  Nome	 			     VARCHAR(50),
  Cognome			     VARCHAR(50),
  Matricola		     VARCHAR(5)	UNIQUE NOT NULL,
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



CREATE TABLE t_generalitaColpiti (
  ID 		           BIGINT				NOT NULL 	AUTO_INCREMENT,
  Nome	 			     VARCHAR(50),
  Cognome			     VARCHAR(50),
  DataDiNascita    Date,
  Residenza        VARCHAR(50),
  Telefono         BIGINT,
  NCartaIdentita   VARCHAR(50),
  Altro            VARCHAR(100),
  PRIMARY KEY(ID)
) ENGINE = InnoDB;

CREATE TABLE t_soccorsiEsterni (
  ID 		           BIGINT				NOT NULL 	AUTO_INCREMENT,
  Descrizione      VARCHAR(50),
  PRIMARY KEY(ID)
) ENGINE = InnoDB;

CREATE TABLE t_comuni (
  ID 		           BIGINT				NOT NULL 	AUTO_INCREMENT,
  Comune      VARCHAR(50),
  PRIMARY KEY(ID)
) ENGINE = InnoDB;

CREATE TABLE t_localita (
  ID 		           BIGINT				NOT NULL 	AUTO_INCREMENT,
  Via              VARCHAR(50),
  FK_Comune        BIGINT,
  PRIMARY KEY(ID),
  FOREIGN KEY(FK_Comune)    REFERENCES t_comuni(ID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;

CREATE TABLE t_rapportiVVF (
  ID 		                    BIGINT				NOT NULL 	AUTO_INCREMENT,
  ID_Rapporto               BIGINT				NOT NULL  UNIQUE,
  OraUscita                 TIME,
  OraRientro                TIME,
  Data                      DATE,
  Urgente                   BOOLEAN,
  OperazioniEseguite        TEXT,
  Osservazioni              TEXT,
  FK_Localita               BIGINT,
  FK_GeneralitaColpito      BIGINT,
  FK_ProvChiamata           BIGINT,
  FK_TipoChiamata           BIGINT,
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
  FOREIGN KEY(FK_Responsabile)    REFERENCES t_vigili(ID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  FOREIGN KEY(FK_Compilatore)    REFERENCES t_vigili(ID)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;

CREATE TABLE t_mezziIntervenuti (
  ID 		            BIGINT				NOT NULL 	AUTO_INCREMENT,
  FK_RapportoVVF    BIGINT,
  FK_Mezzo          BIGINT,
  PRIMARY KEY(ID),
  FOREIGN KEY(FK_RapportoVVF)    REFERENCES t_rapportiVVF(ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY(FK_Mezzo)    REFERENCES t_mezzi(ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

CREATE TABLE t_soccorsiIntervenuti (
  ID 		              BIGINT				NOT NULL 	AUTO_INCREMENT,
  FK_RapportoVVF      BIGINT,
  FK_SoccorsiEsterni  BIGINT,
  PRIMARY KEY(ID),
  FOREIGN KEY(FK_RapportoVVF)    REFERENCES t_rapportiVVF(ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY(FK_SoccorsiEsterni)    REFERENCES t_soccorsiEsterni(ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

CREATE TABLE t_vigiliIntervenuti (
  ID 		            BIGINT				NOT NULL 	AUTO_INCREMENT,
  FK_RapportoVVF    BIGINT,
  FK_Vigile         BIGINT,
  PRIMARY KEY(ID),
  FOREIGN KEY(FK_RapportoVVF)    REFERENCES t_rapportiVVF(ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY(FK_Vigile)    REFERENCES t_vigili(ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

INSERT INTO t_provChiamata (Provenienza) VALUES ('Selettiva Centrale Trento');
INSERT INTO t_provChiamata (Provenienza) VALUES ('Telefono Centrale Trento');
INSERT INTO t_provChiamata (Provenienza) VALUES ('Radio Centrale Trento');
INSERT INTO t_provChiamata (Provenienza) VALUES ('Selettiva Corpo');
INSERT INTO t_provChiamata (Provenienza) VALUES ('Comandante');
INSERT INTO t_provChiamata (Provenienza) VALUES ('Vicecomandante');
INSERT INTO t_provChiamata (Provenienza) VALUES ('Passante');
INSERT INTO t_provChiamata (Provenienza) VALUES ('Telefono');
INSERT INTO t_provChiamata (Provenienza) VALUES ('Servizi');
INSERT INTO t_provChiamata (Provenienza) VALUES ('Altro');

INSERT INTO t_mezzi (Descrizione) VALUES ('VW Interventi Tecnici');
INSERT INTO t_mezzi (Descrizione) VALUES ('VW Pinze');
INSERT INTO t_mezzi (Descrizione) VALUES ('Daily Interventi Tecnici');
INSERT INTO t_mezzi (Descrizione) VALUES ('Autobotte Volvo');
INSERT INTO t_mezzi (Descrizione) VALUES ('Autobotte 180');
INSERT INTO t_mezzi (Descrizione) VALUES ('Minibotte');
INSERT INTO t_mezzi (Descrizione) VALUES ('Autoscala');
INSERT INTO t_mezzi (Descrizione) VALUES ('Snorkel');
INSERT INTO t_mezzi (Descrizione) VALUES ('Autogru MAN');
INSERT INTO t_mezzi (Descrizione) VALUES ('Nissan Terrano');
INSERT INTO t_mezzi (Descrizione) VALUES ('Land Rover TD5');
INSERT INTO t_mezzi (Descrizione) VALUES ('Land Rover TD4');
INSERT INTO t_mezzi (Descrizione) VALUES ('Mitsubishi Pickup');
INSERT INTO t_mezzi (Descrizione) VALUES ('Gommone');
INSERT INTO t_mezzi (Descrizione) VALUES ('Fiat Punto');
INSERT INTO t_mezzi (Descrizione) VALUES ('Daily Trasporto');
INSERT INTO t_mezzi (Descrizione) VALUES ('VW trasp. persone');
INSERT INTO t_mezzi (Descrizione) VALUES ('VW trasp. unione');
INSERT INTO t_mezzi (Descrizione) VALUES ('Carrello trasporto mezzi');
INSERT INTO t_mezzi (Descrizione) VALUES ('Pompa Ziegler');
INSERT INTO t_mezzi (Descrizione) VALUES ('Carrello Ziegler');
INSERT INTO t_mezzi (Descrizione) VALUES ('Carrello incendi boschivi');
INSERT INTO t_mezzi (Descrizione) VALUES ('Pompa Rosenbauer');
INSERT INTO t_mezzi (Descrizione) VALUES ('Carrello gruppo elettrogeno');
INSERT INTO t_mezzi (Descrizione) VALUES ('Idrovora');

INSERT INTO t_soccorsiEsterni (Descrizione) VALUES ('CC Pergine');
INSERT INTO t_soccorsiEsterni (Descrizione) VALUES ('CC Borgo');
INSERT INTO t_soccorsiEsterni (Descrizione) VALUES ('Polizia Municipale');
INSERT INTO t_soccorsiEsterni (Descrizione) VALUES ('Polizia Stradale');
INSERT INTO t_soccorsiEsterni (Descrizione) VALUES ('Medico');
INSERT INTO t_soccorsiEsterni (Descrizione) VALUES ('Ambulanza');
INSERT INTO t_soccorsiEsterni (Descrizione) VALUES ('Gestione Strade');
INSERT INTO t_soccorsiEsterni (Descrizione) VALUES ('Servizi forestali');
INSERT INTO t_soccorsiEsterni (Descrizione) VALUES ('AMNU-Serv. fun.');
INSERT INTO t_soccorsiEsterni (Descrizione) VALUES ('CSA');
INSERT INTO t_soccorsiEsterni (Descrizione) VALUES ('Carro attrezzi');
INSERT INTO t_soccorsiEsterni (Descrizione) VALUES ('Ispettore distrettuale');
INSERT INTO t_soccorsiEsterni (Descrizione) VALUES ('Perito VVF Trento');



INSERT INTO t_tipoChiamata (Tipologia) VALUES ('Allagamento');
INSERT INTO t_tipoChiamata (Tipologia) VALUES ('Apertura porta');
INSERT INTO t_tipoChiamata (Tipologia) VALUES ('Bonifica insetti');
INSERT INTO t_tipoChiamata (Tipologia) VALUES ('Fuga di gas');
INSERT INTO t_tipoChiamata (Tipologia) VALUES ('Incendio abitazione');
INSERT INTO t_tipoChiamata (Tipologia) VALUES ('Incendio autoveicolo');
INSERT INTO t_tipoChiamata (Tipologia) VALUES ('Incendio sterpaglie');
INSERT INTO t_tipoChiamata (Tipologia) VALUES ('Incendio cassonetto');
INSERT INTO t_tipoChiamata (Tipologia) VALUES ('Altri incendi');
INSERT INTO t_tipoChiamata (Tipologia) VALUES ('Incidente stradale');
INSERT INTO t_tipoChiamata (Tipologia) VALUES ('Inquinamento');
INSERT INTO t_tipoChiamata (Tipologia) VALUES ('Manifestazioni');
INSERT INTO t_tipoChiamata (Tipologia) VALUES ('Prevenzione');
INSERT INTO t_tipoChiamata (Tipologia) VALUES ('Pulizia sede stradale');
INSERT INTO t_tipoChiamata (Tipologia) VALUES ('Recupero carico');
INSERT INTO t_tipoChiamata (Tipologia) VALUES ('Sblocco ascensore');
INSERT INTO t_tipoChiamata (Tipologia) VALUES ('Servizio reperibilita');
INSERT INTO t_tipoChiamata (Tipologia) VALUES ('Soccorso animali');
INSERT INTO t_tipoChiamata (Tipologia) VALUES ('Soccorso persona');
INSERT INTO t_tipoChiamata (Tipologia) VALUES ('Soccorso tecnico generico');
INSERT INTO t_tipoChiamata (Tipologia) VALUES ('Sopralluogo incendio');
INSERT INTO t_tipoChiamata (Tipologia) VALUES ('Supporto elicottero');
INSERT INTO t_tipoChiamata (Tipologia) VALUES ('Taglio Pianta');
INSERT INTO t_tipoChiamata (Tipologia) VALUES ('Altro');

INSERT INTO t_comuni (Comune) VALUES ('Pergine Valsugana');
INSERT INTO t_comuni (Comune) VALUES ('Ala');
INSERT INTO t_comuni (Comune) VALUES ('Altopiano della Vigolana');
INSERT INTO t_comuni (Comune) VALUES ('Andalo');
INSERT INTO t_comuni (Comune) VALUES ('Arco');
INSERT INTO t_comuni (Comune) VALUES ('Avio');
INSERT INTO t_comuni (Comune) VALUES ('Baselga di Pine');
INSERT INTO t_comuni (Comune) VALUES ('Bedollo');
INSERT INTO t_comuni (Comune) VALUES ('Bocenago');
INSERT INTO t_comuni (Comune) VALUES ('Bondone');
INSERT INTO t_comuni (Comune) VALUES ('Borgo Valsugana');
INSERT INTO t_comuni (Comune) VALUES ('Calceranica al Lago');
INSERT INTO t_comuni (Comune) VALUES ('Caldonazzo');
INSERT INTO t_comuni (Comune) VALUES ('Cavalese');
INSERT INTO t_comuni (Comune) VALUES ('Civezzano');
INSERT INTO t_comuni (Comune) VALUES ('Cles');
INSERT INTO t_comuni (Comune) VALUES ('Fierozzo');
INSERT INTO t_comuni (Comune) VALUES ('Fornace');
INSERT INTO t_comuni (Comune) VALUES ('Frassilongo');
INSERT INTO t_comuni (Comune) VALUES ('Grigno');
INSERT INTO t_comuni (Comune) VALUES ('Levico Terme');
INSERT INTO t_comuni (Comune) VALUES ('Mezzano');
INSERT INTO t_comuni (Comune) VALUES ('Mezzocorona');
INSERT INTO t_comuni (Comune) VALUES ('Mezzolombardo');
INSERT INTO t_comuni (Comune) VALUES ('Moena');
INSERT INTO t_comuni (Comune) VALUES ('Novaledo');
INSERT INTO t_comuni (Comune) VALUES ('Ospedaletto');
INSERT INTO t_comuni (Comune) VALUES ('Palu del Fersina');
INSERT INTO t_comuni (Comune) VALUES ('Pieve Tesino');
INSERT INTO t_comuni (Comune) VALUES ('Pinzolo');
INSERT INTO t_comuni (Comune) VALUES ('Riva del Garda');
INSERT INTO t_comuni (Comune) VALUES ('Roncegno Terme');
INSERT INTO t_comuni (Comune) VALUES ('Ronchi Valsugana');
INSERT INTO t_comuni (Comune) VALUES ('Rovereto');
INSERT INTO t_comuni (Comune) VALUES ('San Michele all Adige');
INSERT INTO t_comuni (Comune) VALUES ('Sant Orsola Terme');
INSERT INTO t_comuni (Comune) VALUES ('Scurelle');
INSERT INTO t_comuni (Comune) VALUES ('Segonzano');
INSERT INTO t_comuni (Comune) VALUES ('Storo');
INSERT INTO t_comuni (Comune) VALUES ('Telve');
INSERT INTO t_comuni (Comune) VALUES ('Tenna');
INSERT INTO t_comuni (Comune) VALUES ('Tione');
INSERT INTO t_comuni (Comune) VALUES ('Torcegno');
INSERT INTO t_comuni (Comune) VALUES ('Trento');
INSERT INTO t_comuni (Comune) VALUES ('Vignola-Falesina');
