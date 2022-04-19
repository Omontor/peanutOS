<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'team_create',
            ],
            [
                'id'    => 20,
                'title' => 'team_edit',
            ],
            [
                'id'    => 21,
                'title' => 'team_show',
            ],
            [
                'id'    => 22,
                'title' => 'team_delete',
            ],
            [
                'id'    => 23,
                'title' => 'team_access',
            ],
            [
                'id'    => 24,
                'title' => 'course_create',
            ],
            [
                'id'    => 25,
                'title' => 'course_edit',
            ],
            [
                'id'    => 26,
                'title' => 'course_show',
            ],
            [
                'id'    => 27,
                'title' => 'course_delete',
            ],
            [
                'id'    => 28,
                'title' => 'course_access',
            ],
            [
                'id'    => 29,
                'title' => 'lesson_create',
            ],
            [
                'id'    => 30,
                'title' => 'lesson_edit',
            ],
            [
                'id'    => 31,
                'title' => 'lesson_show',
            ],
            [
                'id'    => 32,
                'title' => 'lesson_delete',
            ],
            [
                'id'    => 33,
                'title' => 'lesson_access',
            ],
            [
                'id'    => 34,
                'title' => 'test_create',
            ],
            [
                'id'    => 35,
                'title' => 'test_edit',
            ],
            [
                'id'    => 36,
                'title' => 'test_show',
            ],
            [
                'id'    => 37,
                'title' => 'test_delete',
            ],
            [
                'id'    => 38,
                'title' => 'test_access',
            ],
            [
                'id'    => 39,
                'title' => 'question_create',
            ],
            [
                'id'    => 40,
                'title' => 'question_edit',
            ],
            [
                'id'    => 41,
                'title' => 'question_show',
            ],
            [
                'id'    => 42,
                'title' => 'question_delete',
            ],
            [
                'id'    => 43,
                'title' => 'question_access',
            ],
            [
                'id'    => 44,
                'title' => 'question_option_create',
            ],
            [
                'id'    => 45,
                'title' => 'question_option_edit',
            ],
            [
                'id'    => 46,
                'title' => 'question_option_show',
            ],
            [
                'id'    => 47,
                'title' => 'question_option_delete',
            ],
            [
                'id'    => 48,
                'title' => 'question_option_access',
            ],
            [
                'id'    => 49,
                'title' => 'test_result_create',
            ],
            [
                'id'    => 50,
                'title' => 'test_result_edit',
            ],
            [
                'id'    => 51,
                'title' => 'test_result_show',
            ],
            [
                'id'    => 52,
                'title' => 'test_result_delete',
            ],
            [
                'id'    => 53,
                'title' => 'test_result_access',
            ],
            [
                'id'    => 54,
                'title' => 'test_answer_create',
            ],
            [
                'id'    => 55,
                'title' => 'test_answer_edit',
            ],
            [
                'id'    => 56,
                'title' => 'test_answer_show',
            ],
            [
                'id'    => 57,
                'title' => 'test_answer_delete',
            ],
            [
                'id'    => 58,
                'title' => 'test_answer_access',
            ],
            [
                'id'    => 59,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 60,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 61,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 62,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 63,
                'title' => 'lm_access',
            ],
            [
                'id'    => 64,
                'title' => 'client_management_access',
            ],
            [
                'id'    => 65,
                'title' => 'asset_management_access',
            ],
            [
                'id'    => 66,
                'title' => 'event_management_access',
            ],
            [
                'id'    => 67,
                'title' => 'agency_management_access',
            ],
            [
                'id'    => 68,
                'title' => 'document_manager_access',
            ],
            [
                'id'    => 69,
                'title' => 'client_create',
            ],
            [
                'id'    => 70,
                'title' => 'client_edit',
            ],
            [
                'id'    => 71,
                'title' => 'client_show',
            ],
            [
                'id'    => 72,
                'title' => 'client_delete',
            ],
            [
                'id'    => 73,
                'title' => 'client_access',
            ],
            [
                'id'    => 74,
                'title' => 'product_create',
            ],
            [
                'id'    => 75,
                'title' => 'product_edit',
            ],
            [
                'id'    => 76,
                'title' => 'product_show',
            ],
            [
                'id'    => 77,
                'title' => 'product_delete',
            ],
            [
                'id'    => 78,
                'title' => 'product_access',
            ],
            [
                'id'    => 79,
                'title' => 'project_create',
            ],
            [
                'id'    => 80,
                'title' => 'project_edit',
            ],
            [
                'id'    => 81,
                'title' => 'project_show',
            ],
            [
                'id'    => 82,
                'title' => 'project_delete',
            ],
            [
                'id'    => 83,
                'title' => 'project_access',
            ],
            [
                'id'    => 84,
                'title' => 'basic_data_create',
            ],
            [
                'id'    => 85,
                'title' => 'basic_data_edit',
            ],
            [
                'id'    => 86,
                'title' => 'basic_data_show',
            ],
            [
                'id'    => 87,
                'title' => 'basic_data_delete',
            ],
            [
                'id'    => 88,
                'title' => 'basic_data_access',
            ],
            [
                'id'    => 89,
                'title' => 'contract_create',
            ],
            [
                'id'    => 90,
                'title' => 'contract_edit',
            ],
            [
                'id'    => 91,
                'title' => 'contract_show',
            ],
            [
                'id'    => 92,
                'title' => 'contract_delete',
            ],
            [
                'id'    => 93,
                'title' => 'contract_access',
            ],
            [
                'id'    => 94,
                'title' => 'static_clause_create',
            ],
            [
                'id'    => 95,
                'title' => 'static_clause_edit',
            ],
            [
                'id'    => 96,
                'title' => 'static_clause_show',
            ],
            [
                'id'    => 97,
                'title' => 'static_clause_delete',
            ],
            [
                'id'    => 98,
                'title' => 'static_clause_access',
            ],
            [
                'id'    => 99,
                'title' => 'dynamic_clause_create',
            ],
            [
                'id'    => 100,
                'title' => 'dynamic_clause_edit',
            ],
            [
                'id'    => 101,
                'title' => 'dynamic_clause_show',
            ],
            [
                'id'    => 102,
                'title' => 'dynamic_clause_delete',
            ],
            [
                'id'    => 103,
                'title' => 'dynamic_clause_access',
            ],
            [
                'id'    => 104,
                'title' => 'category_create',
            ],
            [
                'id'    => 105,
                'title' => 'category_edit',
            ],
            [
                'id'    => 106,
                'title' => 'category_show',
            ],
            [
                'id'    => 107,
                'title' => 'category_delete',
            ],
            [
                'id'    => 108,
                'title' => 'category_access',
            ],
            [
                'id'    => 109,
                'title' => 'asset_create',
            ],
            [
                'id'    => 110,
                'title' => 'asset_edit',
            ],
            [
                'id'    => 111,
                'title' => 'asset_show',
            ],
            [
                'id'    => 112,
                'title' => 'asset_delete',
            ],
            [
                'id'    => 113,
                'title' => 'asset_access',
            ],
            [
                'id'    => 114,
                'title' => 'rental_access',
            ],
            [
                'id'    => 115,
                'title' => 'rent_create',
            ],
            [
                'id'    => 116,
                'title' => 'rent_edit',
            ],
            [
                'id'    => 117,
                'title' => 'rent_show',
            ],
            [
                'id'    => 118,
                'title' => 'rent_delete',
            ],
            [
                'id'    => 119,
                'title' => 'rent_access',
            ],
            [
                'id'    => 120,
                'title' => 'quotation_create',
            ],
            [
                'id'    => 121,
                'title' => 'quotation_edit',
            ],
            [
                'id'    => 122,
                'title' => 'quotation_show',
            ],
            [
                'id'    => 123,
                'title' => 'quotation_delete',
            ],
            [
                'id'    => 124,
                'title' => 'quotation_access',
            ],
            [
                'id'    => 125,
                'title' => 'rental_clause_create',
            ],
            [
                'id'    => 126,
                'title' => 'rental_clause_edit',
            ],
            [
                'id'    => 127,
                'title' => 'rental_clause_show',
            ],
            [
                'id'    => 128,
                'title' => 'rental_clause_delete',
            ],
            [
                'id'    => 129,
                'title' => 'rental_clause_access',
            ],
            [
                'id'    => 130,
                'title' => 'approval_create',
            ],
            [
                'id'    => 131,
                'title' => 'approval_edit',
            ],
            [
                'id'    => 132,
                'title' => 'approval_show',
            ],
            [
                'id'    => 133,
                'title' => 'approval_delete',
            ],
            [
                'id'    => 134,
                'title' => 'approval_access',
            ],
            [
                'id'    => 135,
                'title' => 'event_create',
            ],
            [
                'id'    => 136,
                'title' => 'event_edit',
            ],
            [
                'id'    => 137,
                'title' => 'event_show',
            ],
            [
                'id'    => 138,
                'title' => 'event_delete',
            ],
            [
                'id'    => 139,
                'title' => 'event_access',
            ],
            [
                'id'    => 140,
                'title' => 'event_day_create',
            ],
            [
                'id'    => 141,
                'title' => 'event_day_edit',
            ],
            [
                'id'    => 142,
                'title' => 'event_day_show',
            ],
            [
                'id'    => 143,
                'title' => 'event_day_delete',
            ],
            [
                'id'    => 144,
                'title' => 'event_day_access',
            ],
            [
                'id'    => 145,
                'title' => 'venue_create',
            ],
            [
                'id'    => 146,
                'title' => 'venue_edit',
            ],
            [
                'id'    => 147,
                'title' => 'venue_show',
            ],
            [
                'id'    => 148,
                'title' => 'venue_delete',
            ],
            [
                'id'    => 149,
                'title' => 'venue_access',
            ],
            [
                'id'    => 150,
                'title' => 'event_witness_create',
            ],
            [
                'id'    => 151,
                'title' => 'event_witness_edit',
            ],
            [
                'id'    => 152,
                'title' => 'event_witness_show',
            ],
            [
                'id'    => 153,
                'title' => 'event_witness_delete',
            ],
            [
                'id'    => 154,
                'title' => 'event_witness_access',
            ],
            [
                'id'    => 155,
                'title' => 'witness_category_create',
            ],
            [
                'id'    => 156,
                'title' => 'witness_category_edit',
            ],
            [
                'id'    => 157,
                'title' => 'witness_category_show',
            ],
            [
                'id'    => 158,
                'title' => 'witness_category_delete',
            ],
            [
                'id'    => 159,
                'title' => 'witness_category_access',
            ],
            [
                'id'    => 160,
                'title' => 'documentation_manager_access',
            ],
            [
                'id'    => 161,
                'title' => 'website_management_access',
            ],
            [
                'id'    => 162,
                'title' => 'project_category_create',
            ],
            [
                'id'    => 163,
                'title' => 'project_category_edit',
            ],
            [
                'id'    => 164,
                'title' => 'project_category_show',
            ],
            [
                'id'    => 165,
                'title' => 'project_category_delete',
            ],
            [
                'id'    => 166,
                'title' => 'project_category_access',
            ],
            [
                'id'    => 167,
                'title' => 'project_story_create',
            ],
            [
                'id'    => 168,
                'title' => 'project_story_edit',
            ],
            [
                'id'    => 169,
                'title' => 'project_story_show',
            ],
            [
                'id'    => 170,
                'title' => 'project_story_delete',
            ],
            [
                'id'    => 171,
                'title' => 'project_story_access',
            ],
            [
                'id'    => 172,
                'title' => 'blog_create',
            ],
            [
                'id'    => 173,
                'title' => 'blog_edit',
            ],
            [
                'id'    => 174,
                'title' => 'blog_show',
            ],
            [
                'id'    => 175,
                'title' => 'blog_delete',
            ],
            [
                'id'    => 176,
                'title' => 'blog_access',
            ],
            [
                'id'    => 177,
                'title' => 'page_create',
            ],
            [
                'id'    => 178,
                'title' => 'page_edit',
            ],
            [
                'id'    => 179,
                'title' => 'page_show',
            ],
            [
                'id'    => 180,
                'title' => 'page_delete',
            ],
            [
                'id'    => 181,
                'title' => 'page_access',
            ],
            [
                'id'    => 182,
                'title' => 'contact_form_create',
            ],
            [
                'id'    => 183,
                'title' => 'contact_form_edit',
            ],
            [
                'id'    => 184,
                'title' => 'contact_form_show',
            ],
            [
                'id'    => 185,
                'title' => 'contact_form_delete',
            ],
            [
                'id'    => 186,
                'title' => 'contact_form_access',
            ],
            [
                'id'    => 187,
                'title' => 'project_documentation_create',
            ],
            [
                'id'    => 188,
                'title' => 'project_documentation_edit',
            ],
            [
                'id'    => 189,
                'title' => 'project_documentation_show',
            ],
            [
                'id'    => 190,
                'title' => 'project_documentation_delete',
            ],
            [
                'id'    => 191,
                'title' => 'project_documentation_access',
            ],
            [
                'id'    => 192,
                'title' => 'documenation_chapter_create',
            ],
            [
                'id'    => 193,
                'title' => 'documenation_chapter_edit',
            ],
            [
                'id'    => 194,
                'title' => 'documenation_chapter_show',
            ],
            [
                'id'    => 195,
                'title' => 'documenation_chapter_delete',
            ],
            [
                'id'    => 196,
                'title' => 'documenation_chapter_access',
            ],
            [
                'id'    => 197,
                'title' => 'chapter_content_create',
            ],
            [
                'id'    => 198,
                'title' => 'chapter_content_edit',
            ],
            [
                'id'    => 199,
                'title' => 'chapter_content_show',
            ],
            [
                'id'    => 200,
                'title' => 'chapter_content_delete',
            ],
            [
                'id'    => 201,
                'title' => 'chapter_content_access',
            ],
            [
                'id'    => 202,
                'title' => 'client_evaluation_create',
            ],
            [
                'id'    => 203,
                'title' => 'client_evaluation_edit',
            ],
            [
                'id'    => 204,
                'title' => 'client_evaluation_show',
            ],
            [
                'id'    => 205,
                'title' => 'client_evaluation_delete',
            ],
            [
                'id'    => 206,
                'title' => 'client_evaluation_access',
            ],
            [
                'id'    => 207,
                'title' => 'appointments_management_access',
            ],
            [
                'id'    => 208,
                'title' => 'appointment_create',
            ],
            [
                'id'    => 209,
                'title' => 'appointment_edit',
            ],
            [
                'id'    => 210,
                'title' => 'appointment_show',
            ],
            [
                'id'    => 211,
                'title' => 'appointment_delete',
            ],
            [
                'id'    => 212,
                'title' => 'appointment_access',
            ],
            [
                'id'    => 213,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
