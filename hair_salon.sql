--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: clients; Type: TABLE; Schema: public; Owner: kdevries; Tablespace: 
--

CREATE TABLE clients (
    id integer NOT NULL,
    client_name character varying,
    stylist_id integer
);


ALTER TABLE clients OWNER TO kdevries;

--
-- Name: clients_id_seq; Type: SEQUENCE; Schema: public; Owner: kdevries
--

CREATE SEQUENCE clients_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE clients_id_seq OWNER TO kdevries;

--
-- Name: clients_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kdevries
--

ALTER SEQUENCE clients_id_seq OWNED BY clients.id;


--
-- Name: stylists; Type: TABLE; Schema: public; Owner: kdevries; Tablespace: 
--

CREATE TABLE stylists (
    id integer NOT NULL,
    stylist_name character varying,
    stylist_id integer
);


ALTER TABLE stylists OWNER TO kdevries;

--
-- Name: stylists_id_seq; Type: SEQUENCE; Schema: public; Owner: kdevries
--

CREATE SEQUENCE stylists_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE stylists_id_seq OWNER TO kdevries;

--
-- Name: stylists_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: kdevries
--

ALTER SEQUENCE stylists_id_seq OWNED BY stylists.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: kdevries
--

ALTER TABLE ONLY clients ALTER COLUMN id SET DEFAULT nextval('clients_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: kdevries
--

ALTER TABLE ONLY stylists ALTER COLUMN id SET DEFAULT nextval('stylists_id_seq'::regclass);


--
-- Data for Name: clients; Type: TABLE DATA; Schema: public; Owner: kdevries
--

COPY clients (id, client_name, stylist_id) FROM stdin;
\.


--
-- Name: clients_id_seq; Type: SEQUENCE SET; Schema: public; Owner: kdevries
--

SELECT pg_catalog.setval('clients_id_seq', 3, true);


--
-- Data for Name: stylists; Type: TABLE DATA; Schema: public; Owner: kdevries
--

COPY stylists (id, stylist_name, stylist_id) FROM stdin;
81	you	\N
82	me	\N
84	us	\N
85	them	\N
\.


--
-- Name: stylists_id_seq; Type: SEQUENCE SET; Schema: public; Owner: kdevries
--

SELECT pg_catalog.setval('stylists_id_seq', 86, true);


--
-- Name: clients_pkey; Type: CONSTRAINT; Schema: public; Owner: kdevries; Tablespace: 
--

ALTER TABLE ONLY clients
    ADD CONSTRAINT clients_pkey PRIMARY KEY (id);


--
-- Name: stylists_pkey; Type: CONSTRAINT; Schema: public; Owner: kdevries; Tablespace: 
--

ALTER TABLE ONLY stylists
    ADD CONSTRAINT stylists_pkey PRIMARY KEY (id);


--
-- Name: public; Type: ACL; Schema: -; Owner: kdevries
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM kdevries;
GRANT ALL ON SCHEMA public TO kdevries;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

