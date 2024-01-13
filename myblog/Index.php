
<?php
/*
Template Name: Главная страница
*/

get_header(); ?>

    <div id="content" class="site-content">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h1 class="entry-title">Добро пожаловать в блог по Android разработке!</h1>
                    </header>

                    <div class="entry-content">
                        <!-- Ваш контент здесь -->
                    </div>
                </article>

            </main>
        </div>
    </div>

<?php get_footer(); ?>