CREATE TABLE IF NOT EXISTS "users" (
  id serial PRIMARY KEY,
  login varchar UNIQUE NOT NULL,
  pass varchar NOT NULL,
  fName varchar NOT NULL,
  pName varchar,
  surName varchar NOT NULL,
  sex char(1),
  birthday date,
  phone varchar,
  email varchar NOT NULL,
  created timestamp NOT NULL,
  sess_id varchar UNIQUE
);

CREATE INDEX IF NOT EXISTS userSurName ON users (surName);
CREATE INDEX IF NOT EXISTS userMail ON users (eMail);
CREATE INDEX IF NOT EXISTS userPhone ON users (phone);

CREATE TABLE IF NOT EXISTS "roles" (
  id serial PRIMARY KEY,
  roleName varchar UNIQUE NOT NULL,
  "description" varchar
);

CREATE TABLE IF NOT EXISTS "functions" (
  id serial PRIMARY KEY,
  funcName varchar UNIQUE NOT NULL,
  "description" varchar
);

CREATE TABLE IF NOT EXISTS "user_roles" (
  "user" integer NOT NULL REFERENCES "users" (id) ON DELETE CASCADE,
  "role" integer NOT NULL REFERENCES "roles" (id) ON DELETE RESTRICT,
  PRIMARY KEY ("user", "role")
);

CREATE TABLE IF NOT EXISTS "role_function" (
  "role" integer NOT NULL REFERENCES "roles" (id) ON DELETE CASCADE,
  "func" integer NOT NULL REFERENCES "functions" (id) ON DELETE CASCADE,
  PRIMARY KEY ("role", "func")
);