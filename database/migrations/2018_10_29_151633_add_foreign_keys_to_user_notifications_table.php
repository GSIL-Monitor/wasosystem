<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_notifications', function(Blueprint $table)
		{
			$table->foreign('notification_id')->references('id')->on('notifications')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_notifications', function(Blueprint $table)
		{
			$table->dropForeign('user_notifications_notification_id_foreign');
			$table->dropForeign('user_notifications_user_id_foreign');
		});
	}

}
