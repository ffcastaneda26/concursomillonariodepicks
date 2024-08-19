<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
    <section class="h-50 bg-cover bg-center bg-no-repeat flex flex-col justify-center items-center">
            <nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <!-- Menú Normal -->
                        @include('concurso_dashboard_menu_normal')

                        <!-- Hamburger -->
                        @include('hamburger_button')
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                @include('concurso_dashboard_menu_responsive')
            </nav>
    </section>
</div>
