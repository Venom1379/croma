
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Basic info
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // Personal details
            $table->date('dob')->nullable();
            $table->string('contact', 20)->nullable();
            $table->text('address')->nullable();
            $table->string('photo')->nullable();

            // Document details
            $table->enum('doc_type', ['aadhaar', 'passport', 'pan'])->nullable();
            $table->string('doc_number')->nullable();
            $table->string('doc_upload')->nullable();

            // Organization details
            $table->enum('user_type', ['artist', 'organization'])->default('artist');
            $table->string('organization_name')->nullable();
            $table->text('organization_description')->nullable();
            $table->string('organization_certificate')->nullable();

            // Workflow status
            $table->enum('status', [
                'draft',
                'submitted',
                'verified',
                'approved',
                'rejected',
                'active',
                'suspended',
                'expired'
            ])->default('draft');

            // Verification & approval
            $table->unsignedBigInteger('verified_by')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->text('verification_remarks')->nullable();

            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->text('approval_remarks')->nullable();

            // ID card
            $table->string('unique_id')->unique()->nullable();
            $table->date('id_issue_date')->nullable();
            $table->date('id_expiry_date')->nullable();

            // Flags
            $table->boolean('is_active')->default(0);
            $table->boolean('is_deleted')->default(0);

            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');   // Admin, Manager, Govt Verifier
            $table->string('slug')->unique(); // admin, manager, govt_verifier
            $table->timestamps();
        });
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('role_id');

            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

            // Prevent duplicate role assignment
            $table->unique(['user_id', 'role_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_roles');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('users');

    }
};
