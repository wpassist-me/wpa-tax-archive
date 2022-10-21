<?php
/**
 * Plugin Name: WPA Tax Archives
 * Plugin URI: https://wpassist.me/plugins/wpa-tax-archives/
 * Description: Create taxonomy archives easily using [taxarchive] shortcode.
 * Author: Metin Saylan
 * Author URI: https://wpassist.me
 *
 * Version: 20221021
 *
 */


add_shortcode( 'taxarchive', 'wpa_taxarchive_shortcode_render' );
function wpa_taxarchive_shortcode_render( $atts, $content = null ){

  $args = shortcode_atts( array(
    'taxonomy'        => 'category',
    'popular'         => false,
    'popular_count'   => 15,
    'count'           => -1,
    'orderby'         => 'count',
    'order'           => 'DESC',
    'ignore_one'      => false,
  ), $atts );

  extract( $args, EXTR_SKIP );
  
  if( !taxonomy_exists( $taxonomy ) ) return;

  ob_start();
  
  $tax = get_taxonomy( $taxonomy );
  
  // print_r( $tax ); 

  $exclude = array();
  $more = "";
  if( $popular ){

    $terms = get_terms( array(
      'taxonomy' => $taxonomy,
      'orderby'  => 'count',
      'order'    => 'DESC',
      'number'   => $popular_count
    ));
    
    $most_popular = "Most Popular ";
    if( count( $terms ) < $popular_count ){
      $most_popular = "";
    }

    echo "<h2>{$most_popular}{$tax->label}</h2>";
    echo "<ul class=\"flex\">";

    // sort terms by name
    usort( $terms, function($a, $b) {return strcmp($a->name, $b->name);});

    foreach( $terms as $term ){
      $name = $term->name;
      $url = get_term_link( $term->term_id );
      $count = $term->count;
      $exclude[] = $term->term_id;
      echo "<li class=\"md-c1_3\"><a href=\"{$url}\">{$term->name}</a> ({$count})</li>";
    }

    echo "</ul>";
    $more = "More ";
  
  }

  $terms = get_terms( array(
    'taxonomy' => $taxonomy,
    'orderby'  => $orderby,
    'order'    => $order,
    'exclude'  => $exclude
  ));
  
  if( $terms ) {

    echo "<h3>{$more}{$tax->label}</h3>";
    echo "<ul class=\"flex\">";

    foreach( $terms as $term ){
      if( !( $ignore_one && $term->count == 1 ) ){
        $name = $term->name;
        $url = get_term_link( $term->term_id );
        $count = $term->count;
        echo "<li class=\"md-c1_3\"><a href=\"{$url}\">{$term->name}</a> ({$count})</li>";
      }
    }

    echo "</ul>";
  
  }
  
  $output = ob_get_clean();

  return $output;

}