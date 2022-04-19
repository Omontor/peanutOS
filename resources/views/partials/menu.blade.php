<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li>
                    <select class="searchable-field form-control">

                    </select>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('agency_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/basic-datas*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fab fa-pied-piper">

                            </i>
                            <p>
                                {{ trans('cruds.agencyManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('basic_data_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.basic-datas.index") }}" class="nav-link {{ request()->is("admin/basic-datas") || request()->is("admin/basic-datas/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-wrench">

                                        </i>
                                        <p>
                                            {{ trans('cruds.basicData.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('website_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/project-categories*") ? "menu-open" : "" }} {{ request()->is("admin/project-stories*") ? "menu-open" : "" }} {{ request()->is("admin/blogs*") ? "menu-open" : "" }} {{ request()->is("admin/pages*") ? "menu-open" : "" }} {{ request()->is("admin/contact-forms*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-laptop">

                            </i>
                            <p>
                                {{ trans('cruds.websiteManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('project_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.project-categories.index") }}" class="nav-link {{ request()->is("admin/project-categories") || request()->is("admin/project-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-bars">

                                        </i>
                                        <p>
                                            {{ trans('cruds.projectCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('project_story_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.project-stories.index") }}" class="nav-link {{ request()->is("admin/project-stories") || request()->is("admin/project-stories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.projectStory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('blog_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.blogs.index") }}" class="nav-link {{ request()->is("admin/blogs") || request()->is("admin/blogs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-rss">

                                        </i>
                                        <p>
                                            {{ trans('cruds.blog.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('page_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.pages.index") }}" class="nav-link {{ request()->is("admin/pages") || request()->is("admin/pages/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-file-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.page.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('contact_form_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.contact-forms.index") }}" class="nav-link {{ request()->is("admin/contact-forms") || request()->is("admin/contact-forms/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-envelope">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contactForm.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('document_manager_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/contracts*") ? "menu-open" : "" }} {{ request()->is("admin/static-clauses*") ? "menu-open" : "" }} {{ request()->is("admin/dynamic-clauses*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon far fa-file-alt">

                            </i>
                            <p>
                                {{ trans('cruds.documentManager.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('contract_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.contracts.index") }}" class="nav-link {{ request()->is("admin/contracts") || request()->is("admin/contracts/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-contract">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contract.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('static_clause_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.static-clauses.index") }}" class="nav-link {{ request()->is("admin/static-clauses") || request()->is("admin/static-clauses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-file-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.staticClause.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('dynamic_clause_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.dynamic-clauses.index") }}" class="nav-link {{ request()->is("admin/dynamic-clauses") || request()->is("admin/dynamic-clauses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.dynamicClause.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('asset_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/categories*") ? "menu-open" : "" }} {{ request()->is("admin/assets*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-camera-retro">

                            </i>
                            <p>
                                {{ trans('cruds.assetManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.categories.index") }}" class="nav-link {{ request()->is("admin/categories") || request()->is("admin/categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-sort">

                                        </i>
                                        <p>
                                            {{ trans('cruds.category.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('asset_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.assets.index") }}" class="nav-link {{ request()->is("admin/assets") || request()->is("admin/assets/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-barcode">

                                        </i>
                                        <p>
                                            {{ trans('cruds.asset.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('rental_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/rents*") ? "menu-open" : "" }} {{ request()->is("admin/quotations*") ? "menu-open" : "" }} {{ request()->is("admin/rental-clauses*") ? "menu-open" : "" }} {{ request()->is("admin/approvals*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-money-bill-alt">

                            </i>
                            <p>
                                {{ trans('cruds.rental.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('rent_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.rents.index") }}" class="nav-link {{ request()->is("admin/rents") || request()->is("admin/rents/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-align-justify">

                                        </i>
                                        <p>
                                            {{ trans('cruds.rent.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('quotation_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.quotations.index") }}" class="nav-link {{ request()->is("admin/quotations") || request()->is("admin/quotations/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-invoice-dollar">

                                        </i>
                                        <p>
                                            {{ trans('cruds.quotation.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('rental_clause_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.rental-clauses.index") }}" class="nav-link {{ request()->is("admin/rental-clauses") || request()->is("admin/rental-clauses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-contract">

                                        </i>
                                        <p>
                                            {{ trans('cruds.rentalClause.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('approval_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.approvals.index") }}" class="nav-link {{ request()->is("admin/approvals") || request()->is("admin/approvals/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-check-circle">

                                        </i>
                                        <p>
                                            {{ trans('cruds.approval.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('client_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/clients*") ? "menu-open" : "" }} {{ request()->is("admin/products*") ? "menu-open" : "" }} {{ request()->is("admin/projects*") ? "menu-open" : "" }} {{ request()->is("admin/client-evaluations*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-building">

                            </i>
                            <p>
                                {{ trans('cruds.clientManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('client_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.clients.index") }}" class="nav-link {{ request()->is("admin/clients") || request()->is("admin/clients/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-building">

                                        </i>
                                        <p>
                                            {{ trans('cruds.client.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('product_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.products.index") }}" class="nav-link {{ request()->is("admin/products") || request()->is("admin/products/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fab fa-r-project">

                                        </i>
                                        <p>
                                            {{ trans('cruds.product.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('project_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.projects.index") }}" class="nav-link {{ request()->is("admin/projects") || request()->is("admin/projects/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.project.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('client_evaluation_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.client-evaluations.index") }}" class="nav-link {{ request()->is("admin/client-evaluations") || request()->is("admin/client-evaluations/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-sort-numeric-up">

                                        </i>
                                        <p>
                                            {{ trans('cruds.clientEvaluation.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('project_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/managements*") ? "menu-open" : "" }} {{ request()->is("admin/epics*") ? "menu-open" : "" }} {{ request()->is("admin/epic-statuses*") ? "menu-open" : "" }} {{ request()->is("admin/tasks*") ? "menu-open" : "" }} {{ request()->is("admin/task-actions*") ? "menu-open" : "" }} {{ request()->is("admin/status-tasks*") ? "menu-open" : "" }} {{ request()->is("admin/task-mails*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fab fa-pied-piper">

                            </i>
                            <p>
                                {{ trans('cruds.projectManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('management_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.managements.index") }}" class="nav-link {{ request()->is("admin/managements") || request()->is("admin/managements/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-project-diagram">

                                        </i>
                                        <p>
                                            {{ trans('cruds.management.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('epic_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.epics.index") }}" class="nav-link {{ request()->is("admin/epics") || request()->is("admin/epics/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fab fa-algolia">

                                        </i>
                                        <p>
                                            {{ trans('cruds.epic.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('epic_status_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.epic-statuses.index") }}" class="nav-link {{ request()->is("admin/epic-statuses") || request()->is("admin/epic-statuses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.epicStatus.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('task_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tasks.index") }}" class="nav-link {{ request()->is("admin/tasks") || request()->is("admin/tasks/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-check-double">

                                        </i>
                                        <p>
                                            {{ trans('cruds.task.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('task_action_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.task-actions.index") }}" class="nav-link {{ request()->is("admin/task-actions") || request()->is("admin/task-actions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-calendar-plus">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taskAction.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('status_task_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.status-tasks.index") }}" class="nav-link {{ request()->is("admin/status-tasks") || request()->is("admin/status-tasks/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.statusTask.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('task_mail_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.task-mails.index") }}" class="nav-link {{ request()->is("admin/task-mails") || request()->is("admin/task-mails/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-at">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taskMail.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('event_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/events*") ? "menu-open" : "" }} {{ request()->is("admin/event-days*") ? "menu-open" : "" }} {{ request()->is("admin/venues*") ? "menu-open" : "" }} {{ request()->is("admin/witness-categories*") ? "menu-open" : "" }} {{ request()->is("admin/event-witnesses*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon far fa-calendar-alt">

                            </i>
                            <p>
                                {{ trans('cruds.eventManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('event_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.events.index") }}" class="nav-link {{ request()->is("admin/events") || request()->is("admin/events/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.event.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('event_day_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.event-days.index") }}" class="nav-link {{ request()->is("admin/event-days") || request()->is("admin/event-days/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-calendar-check">

                                        </i>
                                        <p>
                                            {{ trans('cruds.eventDay.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('venue_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.venues.index") }}" class="nav-link {{ request()->is("admin/venues") || request()->is("admin/venues/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.venue.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('witness_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.witness-categories.index") }}" class="nav-link {{ request()->is("admin/witness-categories") || request()->is("admin/witness-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-camera">

                                        </i>
                                        <p>
                                            {{ trans('cruds.witnessCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('event_witness_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.event-witnesses.index") }}" class="nav-link {{ request()->is("admin/event-witnesses") || request()->is("admin/event-witnesses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-images">

                                        </i>
                                        <p>
                                            {{ trans('cruds.eventWitness.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/users*") ? "menu-open" : "" }} {{ request()->is("admin/teams*") ? "menu-open" : "" }} {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/audit-logs*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('team_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.teams.index") }}" class="nav-link {{ request()->is("admin/teams") || request()->is("admin/teams/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-users">

                                        </i>
                                        <p>
                                            {{ trans('cruds.team.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('audit_log_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.audit-logs.index") }}" class="nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.auditLog.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('user_alert_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.user-alerts.index") }}" class="nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-bell">

                            </i>
                            <p>
                                {{ trans('cruds.userAlert.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('documentation_manager_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/project-documentations*") ? "menu-open" : "" }} {{ request()->is("admin/documenation-chapters*") ? "menu-open" : "" }} {{ request()->is("admin/chapter-contents*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.documentationManager.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('project_documentation_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.project-documentations.index") }}" class="nav-link {{ request()->is("admin/project-documentations") || request()->is("admin/project-documentations/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-book">

                                        </i>
                                        <p>
                                            {{ trans('cruds.projectDocumentation.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('documenation_chapter_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.documenation-chapters.index") }}" class="nav-link {{ request()->is("admin/documenation-chapters") || request()->is("admin/documenation-chapters/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-bookmark">

                                        </i>
                                        <p>
                                            {{ trans('cruds.documenationChapter.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('chapter_content_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.chapter-contents.index") }}" class="nav-link {{ request()->is("admin/chapter-contents") || request()->is("admin/chapter-contents/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-book">

                                        </i>
                                        <p>
                                            {{ trans('cruds.chapterContent.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('lm_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/courses*") ? "menu-open" : "" }} {{ request()->is("admin/lessons*") ? "menu-open" : "" }} {{ request()->is("admin/tests*") ? "menu-open" : "" }} {{ request()->is("admin/questions*") ? "menu-open" : "" }} {{ request()->is("admin/question-options*") ? "menu-open" : "" }} {{ request()->is("admin/test-results*") ? "menu-open" : "" }} {{ request()->is("admin/test-answers*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-book-open">

                            </i>
                            <p>
                                {{ trans('cruds.lm.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('course_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.courses.index") }}" class="nav-link {{ request()->is("admin/courses") || request()->is("admin/courses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.course.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('lesson_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.lessons.index") }}" class="nav-link {{ request()->is("admin/lessons") || request()->is("admin/lessons/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.lesson.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('test_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tests.index") }}" class="nav-link {{ request()->is("admin/tests") || request()->is("admin/tests/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.test.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('question_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.questions.index") }}" class="nav-link {{ request()->is("admin/questions") || request()->is("admin/questions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.question.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('question_option_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.question-options.index") }}" class="nav-link {{ request()->is("admin/question-options") || request()->is("admin/question-options/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.questionOption.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('test_result_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.test-results.index") }}" class="nav-link {{ request()->is("admin/test-results") || request()->is("admin/test-results/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.testResult.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('test_answer_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.test-answers.index") }}" class="nav-link {{ request()->is("admin/test-answers") || request()->is("admin/test-answers/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.testAnswer.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('appointments_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/appointments*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon far fa-calendar">

                            </i>
                            <p>
                                {{ trans('cruds.appointmentsManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('appointment_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.appointments.index") }}" class="nav-link {{ request()->is("admin/appointments") || request()->is("admin/appointments/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-calendar-check">

                                        </i>
                                        <p>
                                            {{ trans('cruds.appointment.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                <li class="nav-item">
                    <a href="{{ route("admin.systemCalendar") }}" class="nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "active" : "" }}">
                        <i class="fas fa-fw fa-calendar nav-icon">

                        </i>
                        <p>
                            {{ trans('global.systemCalendar') }}
                        </p>
                    </a>
                </li>
                @php($unread = \App\Models\QaTopic::unreadCount())
                    <li class="nav-item">
                        <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "active" : "" }} nav-link">
                            <i class="fa-fw fa fa-envelope nav-icon">

                            </i>
                            <p>{{ trans('global.messages') }}</p>
                            @if($unread > 0)
                                <strong>( {{ $unread }} )</strong>
                            @endif

                        </a>
                    </li>
                    @if(\Illuminate\Support\Facades\Schema::hasColumn('teams', 'owner_id') && \App\Models\Team::where('owner_id', auth()->user()->id)->exists())
                        <li class="nav-item">
                            <a class="{{ request()->is("admin/team-members") || request()->is("admin/team-members/*") ? "active" : "" }} nav-link" href="{{ route("admin.team-members.index") }}">
                                <i class="fa-fw fa fa-users nav-icon">
                                </i>
                                <p>
                                    {{ trans("global.team-members") }}
                                </p>
                            </a>
                        </li>
                    @endif
                    @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                        @can('profile_password_edit')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                    <i class="fa-fw fas fa-key nav-icon">
                                    </i>
                                    <p>
                                        {{ trans('global.change_password') }}
                                    </p>
                                </a>
                            </li>
                        @endcan
                    @endif
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                            <p>
                                <i class="fas fa-fw fa-sign-out-alt nav-icon">

                                </i>
                                <p>{{ trans('global.logout') }}</p>
                            </p>
                        </a>
                    </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>