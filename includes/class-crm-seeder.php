<?php

/**
 * CRM Seeder Class
 */
class WeDevs_ERP_CRM_Seeder {

    function __construct( \Faker\Generator $faker, $count ) {
        $this->faker = $faker;
        $this->count = $count;
    }

    /**
     * Run the seeder functions
     *
     * @return void
     */
    public function run() {
        $this->truncate_all();
        $this->create_contacts_group();
        $this->create_contacts();
    }

    /**
     * Clear the customers table
     *
     * @return void
     */
    public function truncate_all() {
        global $wpdb;

        // truncate the tables
        $tables = [ 'erp_peoples', 'erp_crm_contact_group' ];
        foreach ($tables as $table) {
            $wpdb->query( 'TRUNCATE TABLE ' . $wpdb->prefix . $table );
        }
    }

    /**
     * Create Contacts Group
     *
     * @return void
     */
    function create_contacts_group() {
        for ( $i = 0; $i < 5; $i++ ) {
            $data = [
                'name'        => $this->faker->company,
                'description' => $this->faker->sentence,
            ];
            erp_crm_save_contact_group( $data );
        }
    }

    /**
     * Create contacts
     *
     * @return void
     */
    function create_contacts() {

        for ( $i = 0; $i < $this->count; $i++ ) {
            $genders = ['male', 'female'];
            $types   = ['contact', 'company'];
            shuffle( $genders );
            shuffle( $types );

            $args = array(
                'first_name'  => $this->faker->firstName( $genders[0] ),
                'last_name'   => $this->faker->lastName,
                'email'       => $this->faker->email,
                'company'     => $this->faker->company,
                'phone'       => $this->faker->phoneNumber,
                'mobile'      => '',
                'other'       => '',
                'website'     => $this->faker->url,
                'fax'         => '',
                'notes'       => '',
                'street_1'    => $this->faker->streetAddress,
                'street_2'    => '',
                'city'        => $this->faker->city,
                'state'       => $this->faker->state,
                'postal_code' => $this->faker->postcode,
                'country'     => $this->faker->country,
                'currency'    => '',
                'type'        => $types[0],
            );
            erp_insert_people( $args );

        }
    }
}