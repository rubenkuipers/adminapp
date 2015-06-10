<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('invoices', function($table) {
			$table->foreign('client_id')
      			->references('id')->on('clients')
      			->onDelete('cascade');
      		$table->foreign('project_id')
      			->references('id')->on('projects')
      			->onDelete('cascade');
		});

		Schema::table('projects', function($table) {
			$table->foreign('category_id')
      			->references('id')->on('categories')
      			->onDelete('cascade');
      		$table->foreign('client_id')
      			->references('id')->on('clients')
      			->onDelete('cascade');
      		$table->foreign('tasklist_id')
      			->references('id')->on('tasklists')
      			->onDelete('cascade');
      		$table->foreign('invoice_id')
      			->references('id')->on('invoices')
      			->onDelete('cascade');
		});

		Schema::table('tasklists', function($table) {
		    $table->foreign('project_id')
      			->references('id')->on('projects')
      			->onDelete('cascade');
		});

		Schema::table('tasks', function($table) {
			$table->foreign('tasklist_id')
      			->references('id')->on('tasklists')
      			->onDelete('cascade');
      	});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('invoices', function($table) {
			$table->dropForeign('invoices_client_id_foreign');
			$table->dropForeign('invoices_project_id_foreign');
		});
		Schema::table('projects', function($table) {
			$table->dropForeign('projects_category_id_foreign');
			$table->dropForeign('projects_client_id_foreign');
			$table->dropForeign('projects_tasklist_id_foreign');
			$table->dropForeign('projects_invoice_id_foreign');
		});
		Schema::table('tasklists', function($table) {
		    $table->dropForeign('tasklists_project_id_foreign');
		});
		Schema::table('tasks', function($table) {
		    $table->dropForeign('tasks_tasklist_id_foreign');
		});
	}

}
