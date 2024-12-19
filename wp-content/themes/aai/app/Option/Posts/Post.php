<?php

// Control core classes for avoid errors
if (class_exists('CSF')) {

  //
  // Set a unique slug-like ID
  $post_prefix = 'aai_post_options';

  //
  // Create a metabox for post
  CSF::createMetabox($post_prefix, array(
    'title'     => 'Settings',
    'post_type' => 'post',
  ));

  //
  // Header section
  CSF::createSection($post_prefix, array(
    'title'  =>  esc_html__('Video', 'aai'),
    'fields' => array(

      array(
        'id'    => 'feature_video_id',
        'type'  => 'text',
        'title'  =>  esc_html__('Video Url', 'aai'),
        'desc'  =>  esc_html__('Provide Url here From Youtube', 'aai'),
      ),

    )
  ));

  CSF::createSection($post_prefix, array(
    'title'  =>  esc_html__('Audio', 'aai'),
    'fields' => array(

      array(
        'id'    => 'feature_audio',
        'type'  => 'text',
        'title'  =>  esc_html__('Audio URL', 'aai'),
        'desc'  =>  esc_html__('Provide SoundCloud audio url', 'aai'),
      ),

    )
  ));

  CSF::createSection($post_prefix, array(
    'title'  =>  esc_html__('Quote', 'aai'),
    'fields' => array(

      array(
        'id'    => 'testimonial',
        'type'  => 'textarea',
        'title'  =>  esc_html__('Testimonial URL', 'aai'),
        'desc'  =>  esc_html__('Provide Customer Review', 'aai'),
      ),

    )
  ));
}
