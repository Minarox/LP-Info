<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201105160524 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'CMA style';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("
        create table container_ship
(
    id              serial not null
        constraint container_ship_pk
            primary key,
    name            text,
    captain_name    text,
    container_limit integer
);

comment on table container_ship is 'Vous voyez les bateaux qui transportent des conteneurs, c''est ça';

alter table container_ship
    owner to postgres;

create table container_model
(
    id     serial not null
        constraint container_model_pk
            primary key,
    name   varchar(255) default NULL::character varying,
    length integer,
    width  integer,
    height integer
);

alter table container_model
    owner to postgres;

create table container
(
    id                         serial not null
        constraint container_pk
            primary key,
    color                      varchar(20),
    container_model_id         integer
        constraint container_container_model_id_fk
            references container_model,
    container_container_ship_id integer
        constraint container_container_ship_id_fk
            references container_ship
);

comment on table container is 'Vous voyer les conteneurs sur les bateaux, c''est ça';

alter table container
    owner to postgres;

create table product
(
    id     serial not null
        constraint product_pk
            primary key,
    name   varchar(255) default NULL::character varying,
    length integer,
    width  integer,
    height integer
);

comment on table product is 'C''est des trucs qu''on met dans les conteneurs';

alter table product
    owner to postgres;

create table container_product
(
    id           serial not null,
    container_id integer
        constraint container_product_container_id_fk
            references container,
    product_id   integer
        constraint container_product_product_id_fk
            references product,
    quantity     integer
);

comment on table container_product is 'C''est là où on stocke le nombre de produits dans les conteneurs';

alter table container_product
    owner to postgres;


        ");
        $this->addSql("INSERT INTO product (id, name, length, width, height) VALUES (1, 'Voiture', 4000, 2500, 2000);
INSERT INTO product (id, name, length, width, height) VALUES (2, 'Switch', 500, 200, 150);
INSERT INTO product (id, name, length, width, height) VALUES (3, 'Sel', 1000, 1000, 1000);
INSERT INTO product (id, name, length, width, height) VALUES (4, 'Biere', 500, 300, 500);");
        $this->addSql("
        INSERT INTO container_model (id, name, length, width, height) VALUES (1, 'Ptit Container', 5000, 3000, 3000);
INSERT INTO container_model (id, name, length, width, height) VALUES (2, 'Moyen Container', 10000, 3000, 3000);
INSERT INTO container_model (id, name, length, width, height) VALUES (3, 'Fat Container', 20000, 3000, 3000);
        ");

        $this->addSql("INSERT INTO container_ship (id, name, captain_name, container_limit) VALUES (1, 'Costa Concorla', 'Bob', 600);
INSERT INTO container_ship (id, name, captain_name, container_limit) VALUES (2, 'Petite Barque', 'Fernandel', 1);
INSERT INTO container_ship (id, name, captain_name, container_limit) VALUES (3, 'Ptitanic', 'Gérard', 6);");

        $this->addSql("
        INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (3, 'ROUGE', 3, 2);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (4, 'BLEU', 1, 3);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (5, 'BLEU', 1, 3);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (6, 'BLEU', 1, 3);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (7, 'BLEU', 1, 3);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (8, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (9, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (10, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (11, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (12, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (13, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (14, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (15, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (16, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (17, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (18, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (19, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (20, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (21, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (22, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (23, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (24, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (25, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (26, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (27, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (28, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (29, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (30, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (31, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (32, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (33, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (34, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (35, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (36, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (37, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (38, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (39, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (40, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (41, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (42, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (43, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (44, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (45, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (46, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (47, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (48, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (49, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (50, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (51, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (52, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (53, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (54, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (55, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (56, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (57, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (58, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (59, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (60, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (61, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (62, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (63, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (64, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (65, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (66, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (67, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (68, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (69, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (70, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (71, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (72, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (73, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (74, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (75, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (76, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (77, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (78, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (79, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (80, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (81, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (82, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (83, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (84, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (85, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (86, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (87, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (88, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (89, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (90, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (91, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (92, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (93, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (94, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (95, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (96, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (97, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (98, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (99, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (100, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (101, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (102, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (103, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (104, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (105, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (106, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (107, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (108, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (109, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (110, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (111, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (112, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (113, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (114, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (115, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (116, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (117, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (118, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (119, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (120, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (121, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (122, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (123, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (124, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (125, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (126, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (127, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (128, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (129, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (130, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (131, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (132, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (133, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (134, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (135, 'VERT', 2, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (136, 'VERT', 3, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (137, 'VERT', 3, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (138, 'VERT', 3, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (139, 'VERT', 3, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (140, 'VERT', 3, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (141, 'VERT', 3, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (142, 'VERT', 3, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (143, 'VERT', 3, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (144, 'VERT', 3, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (145, 'VERT', 3, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (146, 'VERT', 3, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (147, 'VERT', 3, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (148, 'VERT', 3, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (149, 'VERT', 3, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (150, 'VERT', 3, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (151, 'VERT', 3, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (152, 'VERT', 3, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (153, 'VERT', 3, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (154, 'VERT', 3, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (155, 'VERT', 3, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (156, 'VERT', 3, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (157, 'VERT', 3, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (158, 'VERT', 3, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (159, 'VERT', 3, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (160, 'VERT', 3, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (161, 'VERT', 3, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (162, 'VERT', 3, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (163, 'VERT', 3, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (164, 'VERT', 3, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (165, 'VERT', 3, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (166, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (167, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (168, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (169, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (170, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (171, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (172, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (173, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (174, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (175, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (176, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (177, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (178, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (179, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (180, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (181, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (182, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (183, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (184, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (185, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (186, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (187, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (188, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (189, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (190, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (191, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (192, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (193, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (194, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (195, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (196, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (197, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (198, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (199, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (200, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (201, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (202, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (203, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (204, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (205, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (206, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (207, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (208, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (209, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (210, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (211, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (212, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (213, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (214, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (215, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (216, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (217, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (218, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (219, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (220, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (221, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (222, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (223, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (224, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (225, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (226, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (227, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (228, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (229, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (230, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (231, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (232, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (233, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (234, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (235, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (236, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (237, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (238, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (239, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (240, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (241, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (242, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (243, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (244, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (245, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (246, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (247, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (248, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (249, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (250, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (251, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (252, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (253, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (254, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (255, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (256, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (257, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (258, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (259, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (260, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (261, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (262, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (263, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (264, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (265, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (266, 'VERT', 1, 1);
INSERT INTO container (id, color, container_model_id, container_container_ship_id) VALUES (267, 'VERT', 1, 1);");
        $this->addSql("INSERT INTO container_product (id, container_id, product_id, quantity) VALUES (1, 3, 1, 1);
INSERT INTO container_product (id, container_id, product_id, quantity) VALUES (2, 3, 4, 1000);
INSERT INTO container_product (id, container_id, product_id, quantity) VALUES (3, 151, 4, 2400);");
    }
    
    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
