<?php
/* Template Name: Projects Page */
get_header(); ?>

<style>
  .projects-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    padding: 20px;
  }

  .project-item {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    background-color: #fff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  body.is-dark-theme .project-item h2 {
    color: #000;
    /* or a lighter color like #eee */
  }

  .project-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
  }

  .project-thumbnail img {
    max-width: 100%;
    border-radius: 4px;
  }

  .project-links a {
    display: inline-block;
    margin-right: 10px;
    padding: 8px 12px;
    background-color: #0073aa;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.2s ease;
  }

  .project-links a:hover {
    background-color: #005177;
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    .projects-container {
      grid-template-columns: 1fr;
      /* Single column for smaller screens */
    }

    .project-item {
      padding: 10px;
    }

    .project-links a {
      margin-right: 5px;
      padding: 6px 10px;
    }
  }

  @media (max-width: 480px) {
    .project-item h2 {
      font-size: 1.2rem;
      /* Adjust title size for very small screens */
    }

    .project-links a {
      font-size: 0.9rem;
      padding: 5px 8px;
    }
  }
</style>

<h1 class="page-title" style="text-align: center; margin: 20px 0; font-size: 2.5rem;">My projects</h1>

<div class="projects-container">
  <?php
  $args = array(
    'post_type' => 'project',
    'posts_per_page' => -1, // Display all projects
  );

  $projects = new WP_Query($args);

  if ($projects->have_posts()) :
    while ($projects->have_posts()) : $projects->the_post(); ?>
      <div class="project-item">
        <h2><?php the_title(); ?></h2>
        <div class="project-thumbnail"><?php the_post_thumbnail(); ?></div>
        <div class="project-content"><?php the_excerpt(); ?></div>
        <div class="project-links">
          <?php
          $github_url = get_post_meta(get_the_ID(), 'github_url', true);
          $live_demo_url = get_post_meta(get_the_ID(), 'live_demo_url', true);
          if ($github_url) : ?>
            <a href="<?php echo esc_url($github_url); ?>" target="_blank">View on GitHub</a>
          <?php endif; ?>
          <?php if ($live_demo_url) : ?>
            <a href="<?php echo esc_url($live_demo_url); ?>" target="_blank">View Live Demo</a>
          <?php endif; ?>
        </div>
      </div>
  <?php endwhile;
    wp_reset_postdata();
  else :
    echo '<p>No projects found.</p>';
  endif;
  ?>
</div>

<?php get_footer(); ?>