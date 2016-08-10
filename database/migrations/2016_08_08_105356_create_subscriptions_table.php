<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('type');
            $table->text('description');
            $table->string('company_profile');
            $table->string('upload_company_logo');
            $table->string('dynamic_display_of_donations');
            $table->string('service_descriptions');
            $table->string('upload_video');
            $table->string('adjustable_opening_hours');
            $table->string('offering_photos');
            $table->string('upload_map_direction');
            $table->string('custom_accessibility_logo');
            $table->string('upload_company_accreditation_logo');
            $table->string('business_preference_linkup');
            $table->string('receive_donation');
            $table->string('nominate_charity_to_receive_off');
            $table->boolean('is_active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('subscriptions');
    }
}
