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
                'title' => 'project_management_access',
            ],
            [
                'id'    => 66,
                'title' => 'asset_management_access',
            ],
            [
                'id'    => 67,
                'title' => 'event_management_access',
            ],
            [
                'id'    => 68,
                'title' => 'agency_management_access',
            ],
            [
                'id'    => 69,
                'title' => 'document_manager_access',
            ],
            [
                'id'    => 70,
                'title' => 'client_create',
            ],
            [
                'id'    => 71,
                'title' => 'client_edit',
            ],
            [
                'id'    => 72,
                'title' => 'client_show',
            ],
            [
                'id'    => 73,
                'title' => 'client_delete',
            ],
            [
                'id'    => 74,
                'title' => 'client_access',
            ],
            [
                'id'    => 75,
                'title' => 'product_create',
            ],
            [
                'id'    => 76,
                'title' => 'product_edit',
            ],
            [
                'id'    => 77,
                'title' => 'product_show',
            ],
            [
                'id'    => 78,
                'title' => 'product_delete',
            ],
            [
                'id'    => 79,
                'title' => 'product_access',
            ],
            [
                'id'    => 80,
                'title' => 'project_create',
            ],
            [
                'id'    => 81,
                'title' => 'project_edit',
            ],
            [
                'id'    => 82,
                'title' => 'project_show',
            ],
            [
                'id'    => 83,
                'title' => 'project_delete',
            ],
            [
                'id'    => 84,
                'title' => 'project_access',
            ],
            [
                'id'    => 85,
                'title' => 'basic_data_create',
            ],
            [
                'id'    => 86,
                'title' => 'basic_data_edit',
            ],
            [
                'id'    => 87,
                'title' => 'basic_data_show',
            ],
            [
                'id'    => 88,
                'title' => 'basic_data_delete',
            ],
            [
                'id'    => 89,
                'title' => 'basic_data_access',
            ],
            [
                'id'    => 90,
                'title' => 'contract_create',
            ],
            [
                'id'    => 91,
                'title' => 'contract_edit',
            ],
            [
                'id'    => 92,
                'title' => 'contract_show',
            ],
            [
                'id'    => 93,
                'title' => 'contract_delete',
            ],
            [
                'id'    => 94,
                'title' => 'contract_access',
            ],
            [
                'id'    => 95,
                'title' => 'static_clause_create',
            ],
            [
                'id'    => 96,
                'title' => 'static_clause_edit',
            ],
            [
                'id'    => 97,
                'title' => 'static_clause_show',
            ],
            [
                'id'    => 98,
                'title' => 'static_clause_delete',
            ],
            [
                'id'    => 99,
                'title' => 'static_clause_access',
            ],
            [
                'id'    => 100,
                'title' => 'dynamic_clause_create',
            ],
            [
                'id'    => 101,
                'title' => 'dynamic_clause_edit',
            ],
            [
                'id'    => 102,
                'title' => 'dynamic_clause_show',
            ],
            [
                'id'    => 103,
                'title' => 'dynamic_clause_delete',
            ],
            [
                'id'    => 104,
                'title' => 'dynamic_clause_access',
            ],
            [
                'id'    => 105,
                'title' => 'category_create',
            ],
            [
                'id'    => 106,
                'title' => 'category_edit',
            ],
            [
                'id'    => 107,
                'title' => 'category_show',
            ],
            [
                'id'    => 108,
                'title' => 'category_delete',
            ],
            [
                'id'    => 109,
                'title' => 'category_access',
            ],
            [
                'id'    => 110,
                'title' => 'asset_create',
            ],
            [
                'id'    => 111,
                'title' => 'asset_edit',
            ],
            [
                'id'    => 112,
                'title' => 'asset_show',
            ],
            [
                'id'    => 113,
                'title' => 'asset_delete',
            ],
            [
                'id'    => 114,
                'title' => 'asset_access',
            ],
            [
                'id'    => 115,
                'title' => 'rental_access',
            ],
            [
                'id'    => 116,
                'title' => 'rent_create',
            ],
            [
                'id'    => 117,
                'title' => 'rent_edit',
            ],
            [
                'id'    => 118,
                'title' => 'rent_show',
            ],
            [
                'id'    => 119,
                'title' => 'rent_delete',
            ],
            [
                'id'    => 120,
                'title' => 'rent_access',
            ],
            [
                'id'    => 121,
                'title' => 'quotation_create',
            ],
            [
                'id'    => 122,
                'title' => 'quotation_edit',
            ],
            [
                'id'    => 123,
                'title' => 'quotation_show',
            ],
            [
                'id'    => 124,
                'title' => 'quotation_delete',
            ],
            [
                'id'    => 125,
                'title' => 'quotation_access',
            ],
            [
                'id'    => 126,
                'title' => 'rental_clause_create',
            ],
            [
                'id'    => 127,
                'title' => 'rental_clause_edit',
            ],
            [
                'id'    => 128,
                'title' => 'rental_clause_show',
            ],
            [
                'id'    => 129,
                'title' => 'rental_clause_delete',
            ],
            [
                'id'    => 130,
                'title' => 'rental_clause_access',
            ],
            [
                'id'    => 131,
                'title' => 'approval_create',
            ],
            [
                'id'    => 132,
                'title' => 'approval_edit',
            ],
            [
                'id'    => 133,
                'title' => 'approval_show',
            ],
            [
                'id'    => 134,
                'title' => 'approval_delete',
            ],
            [
                'id'    => 135,
                'title' => 'approval_access',
            ],
            [
                'id'    => 136,
                'title' => 'event_create',
            ],
            [
                'id'    => 137,
                'title' => 'event_edit',
            ],
            [
                'id'    => 138,
                'title' => 'event_show',
            ],
            [
                'id'    => 139,
                'title' => 'event_delete',
            ],
            [
                'id'    => 140,
                'title' => 'event_access',
            ],
            [
                'id'    => 141,
                'title' => 'event_day_create',
            ],
            [
                'id'    => 142,
                'title' => 'event_day_edit',
            ],
            [
                'id'    => 143,
                'title' => 'event_day_show',
            ],
            [
                'id'    => 144,
                'title' => 'event_day_delete',
            ],
            [
                'id'    => 145,
                'title' => 'event_day_access',
            ],
            [
                'id'    => 146,
                'title' => 'venue_create',
            ],
            [
                'id'    => 147,
                'title' => 'venue_edit',
            ],
            [
                'id'    => 148,
                'title' => 'venue_show',
            ],
            [
                'id'    => 149,
                'title' => 'venue_delete',
            ],
            [
                'id'    => 150,
                'title' => 'venue_access',
            ],
            [
                'id'    => 151,
                'title' => 'event_witness_create',
            ],
            [
                'id'    => 152,
                'title' => 'event_witness_edit',
            ],
            [
                'id'    => 153,
                'title' => 'event_witness_show',
            ],
            [
                'id'    => 154,
                'title' => 'event_witness_delete',
            ],
            [
                'id'    => 155,
                'title' => 'event_witness_access',
            ],
            [
                'id'    => 156,
                'title' => 'witness_category_create',
            ],
            [
                'id'    => 157,
                'title' => 'witness_category_edit',
            ],
            [
                'id'    => 158,
                'title' => 'witness_category_show',
            ],
            [
                'id'    => 159,
                'title' => 'witness_category_delete',
            ],
            [
                'id'    => 160,
                'title' => 'witness_category_access',
            ],
            [
                'id'    => 161,
                'title' => 'management_create',
            ],
            [
                'id'    => 162,
                'title' => 'management_edit',
            ],
            [
                'id'    => 163,
                'title' => 'management_show',
            ],
            [
                'id'    => 164,
                'title' => 'management_delete',
            ],
            [
                'id'    => 165,
                'title' => 'management_access',
            ],
            [
                'id'    => 166,
                'title' => 'epic_create',
            ],
            [
                'id'    => 167,
                'title' => 'epic_edit',
            ],
            [
                'id'    => 168,
                'title' => 'epic_show',
            ],
            [
                'id'    => 169,
                'title' => 'epic_delete',
            ],
            [
                'id'    => 170,
                'title' => 'epic_access',
            ],
            [
                'id'    => 171,
                'title' => 'epic_status_create',
            ],
            [
                'id'    => 172,
                'title' => 'epic_status_edit',
            ],
            [
                'id'    => 173,
                'title' => 'epic_status_show',
            ],
            [
                'id'    => 174,
                'title' => 'epic_status_delete',
            ],
            [
                'id'    => 175,
                'title' => 'epic_status_access',
            ],
            [
                'id'    => 176,
                'title' => 'task_create',
            ],
            [
                'id'    => 177,
                'title' => 'task_edit',
            ],
            [
                'id'    => 178,
                'title' => 'task_show',
            ],
            [
                'id'    => 179,
                'title' => 'task_delete',
            ],
            [
                'id'    => 180,
                'title' => 'task_access',
            ],
            [
                'id'    => 181,
                'title' => 'task_action_create',
            ],
            [
                'id'    => 182,
                'title' => 'task_action_edit',
            ],
            [
                'id'    => 183,
                'title' => 'task_action_show',
            ],
            [
                'id'    => 184,
                'title' => 'task_action_delete',
            ],
            [
                'id'    => 185,
                'title' => 'task_action_access',
            ],
            [
                'id'    => 186,
                'title' => 'status_task_create',
            ],
            [
                'id'    => 187,
                'title' => 'status_task_edit',
            ],
            [
                'id'    => 188,
                'title' => 'status_task_show',
            ],
            [
                'id'    => 189,
                'title' => 'status_task_delete',
            ],
            [
                'id'    => 190,
                'title' => 'status_task_access',
            ],
            [
                'id'    => 191,
                'title' => 'task_mail_create',
            ],
            [
                'id'    => 192,
                'title' => 'task_mail_edit',
            ],
            [
                'id'    => 193,
                'title' => 'task_mail_show',
            ],
            [
                'id'    => 194,
                'title' => 'task_mail_delete',
            ],
            [
                'id'    => 195,
                'title' => 'task_mail_access',
            ],
            [
                'id'    => 196,
                'title' => 'documentation_manager_access',
            ],
            [
                'id'    => 197,
                'title' => 'website_management_access',
            ],
            [
                'id'    => 198,
                'title' => 'project_category_create',
            ],
            [
                'id'    => 199,
                'title' => 'project_category_edit',
            ],
            [
                'id'    => 200,
                'title' => 'project_category_show',
            ],
            [
                'id'    => 201,
                'title' => 'project_category_delete',
            ],
            [
                'id'    => 202,
                'title' => 'project_category_access',
            ],
            [
                'id'    => 203,
                'title' => 'project_story_create',
            ],
            [
                'id'    => 204,
                'title' => 'project_story_edit',
            ],
            [
                'id'    => 205,
                'title' => 'project_story_show',
            ],
            [
                'id'    => 206,
                'title' => 'project_story_delete',
            ],
            [
                'id'    => 207,
                'title' => 'project_story_access',
            ],
            [
                'id'    => 208,
                'title' => 'blog_create',
            ],
            [
                'id'    => 209,
                'title' => 'blog_edit',
            ],
            [
                'id'    => 210,
                'title' => 'blog_show',
            ],
            [
                'id'    => 211,
                'title' => 'blog_delete',
            ],
            [
                'id'    => 212,
                'title' => 'blog_access',
            ],
            [
                'id'    => 213,
                'title' => 'page_create',
            ],
            [
                'id'    => 214,
                'title' => 'page_edit',
            ],
            [
                'id'    => 215,
                'title' => 'page_show',
            ],
            [
                'id'    => 216,
                'title' => 'page_delete',
            ],
            [
                'id'    => 217,
                'title' => 'page_access',
            ],
            [
                'id'    => 218,
                'title' => 'contact_form_create',
            ],
            [
                'id'    => 219,
                'title' => 'contact_form_edit',
            ],
            [
                'id'    => 220,
                'title' => 'contact_form_show',
            ],
            [
                'id'    => 221,
                'title' => 'contact_form_delete',
            ],
            [
                'id'    => 222,
                'title' => 'contact_form_access',
            ],
            [
                'id'    => 223,
                'title' => 'project_documentation_create',
            ],
            [
                'id'    => 224,
                'title' => 'project_documentation_edit',
            ],
            [
                'id'    => 225,
                'title' => 'project_documentation_show',
            ],
            [
                'id'    => 226,
                'title' => 'project_documentation_delete',
            ],
            [
                'id'    => 227,
                'title' => 'project_documentation_access',
            ],
            [
                'id'    => 228,
                'title' => 'documenation_chapter_create',
            ],
            [
                'id'    => 229,
                'title' => 'documenation_chapter_edit',
            ],
            [
                'id'    => 230,
                'title' => 'documenation_chapter_show',
            ],
            [
                'id'    => 231,
                'title' => 'documenation_chapter_delete',
            ],
            [
                'id'    => 232,
                'title' => 'documenation_chapter_access',
            ],
            [
                'id'    => 233,
                'title' => 'chapter_content_create',
            ],
            [
                'id'    => 234,
                'title' => 'chapter_content_edit',
            ],
            [
                'id'    => 235,
                'title' => 'chapter_content_show',
            ],
            [
                'id'    => 236,
                'title' => 'chapter_content_delete',
            ],
            [
                'id'    => 237,
                'title' => 'chapter_content_access',
            ],
            [
                'id'    => 238,
                'title' => 'client_evaluation_create',
            ],
            [
                'id'    => 239,
                'title' => 'client_evaluation_edit',
            ],
            [
                'id'    => 240,
                'title' => 'client_evaluation_show',
            ],
            [
                'id'    => 241,
                'title' => 'client_evaluation_delete',
            ],
            [
                'id'    => 242,
                'title' => 'client_evaluation_access',
            ],
            [
                'id'    => 243,
                'title' => 'appointments_management_access',
            ],
            [
                'id'    => 244,
                'title' => 'appointment_create',
            ],
            [
                'id'    => 245,
                'title' => 'appointment_edit',
            ],
            [
                'id'    => 246,
                'title' => 'appointment_show',
            ],
            [
                'id'    => 247,
                'title' => 'appointment_delete',
            ],
            [
                'id'    => 248,
                'title' => 'appointment_access',
            ],
            [
                'id'    => 249,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
