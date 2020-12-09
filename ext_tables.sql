#
# Table structure for table 'tx_packinglist_domain_model_category'
#
CREATE TABLE tx_packinglist_domain_model_category
(
    name       varchar(255)     DEFAULT ''  NOT NULL,
    listing    int(10) unsigned DEFAULT '0' NOT NULL,
    list_items int(10) unsigned DEFAULT '0' NOT NULL
);

#
# Table structure for table 'tx_packinglist_domain_model_listing'
#
CREATE TABLE tx_packinglist_domain_model_listing
(
    name       varchar(255)     DEFAULT ''  NOT NULL,
    owner      int(10) unsigned DEFAULT '0' NOT NULL,
    categories int(10) unsigned DEFAULT '0' NOT NULL,
    list_items int(10) unsigned DEFAULT '0' NOT NULL
);

#
# Table structure for table 'tx_packinglist_domain_model_listitem'
#
CREATE TABLE tx_packinglist_domain_model_listitem
(
    name        varchar(255)         DEFAULT ''  NOT NULL,
    listing     int(10) unsigned     DEFAULT '0' NOT NULL,
    category    int(10) unsigned     DEFAULT '0' NOT NULL,
    shelf       int(10) unsigned     DEFAULT '0' NOT NULL,
    description text,
    url         text,
    weight      float(4, 4) unsigned DEFAULT '0' NOT NULL,
    unit        varchar(255)         DEFAULT ''  NOT NULL,
    quantity    int(10) unsigned     DEFAULT '0' NOT NULL,
    price       float(4, 4) unsigned DEFAULT '0' NOT NULL,
    worn        smallint(5) unsigned DEFAULT '0' NOT NULL,
    consumable  smallint(5) unsigned DEFAULT '0' NOT NULL
);

#
# Table structure for table 'tx_packinglist_domain_model_shelf'
#
CREATE TABLE tx_packinglist_domain_model_shelf
(
    owner      int(10) unsigned DEFAULT '0' NOT NULL,
    list_items int(10) unsigned DEFAULT '0' NOT NULL
);

#
# Table structure for table 'tx_packinglist_listing_listitem_mm'
#
CREATE TABLE tx_packinglist_listing_listitem_mm
(
    uid_local       int(11) DEFAULT '0' NOT NULL,
    uid_foreign     int(11) DEFAULT '0' NOT NULL,
    sorting         int(11) DEFAULT '0' NOT NULL,
    sorting_foreign int(11) DEFAULT '0' NOT NULL,

    KEY uid_local_foreign (uid_local, uid_foreign),
    KEY uid_foreign_tablefield (uid_foreign, sorting_foreign)
);
