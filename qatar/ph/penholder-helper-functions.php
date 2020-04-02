<?php
/*
 *--------------------------------------------
 *
 * Let's make wordpress easier :P
 *
 *--------------------------------------------*/

/**
 * Get theme name
 */
function get_theme_text_domain()
{
	return wp_get_theme()->get('TextDomain');
}

/**
 * Get current language code
 */
function get_current_language()
{
	return substr(get_locale(), 0, 2);
}

/**
 * Convert plain text into link
 */
function fix_link($raw_link)
{
	$reg_ex = '@(http(s)?)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^‌​,.\s])@';
	$link   = preg_replace($reg_ex, 'http$2://$4', $raw_link);
   
	return $link;
}

function pretty_link($raw_link)
{
	$reg_ex = '@(http(s)?)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^‌​,.\s])@';
	$link   = preg_replace($reg_ex, '$4', $raw_link);
   
	return rtrim($link, '/');
}

/**
 *--------------------------------------------
 * Body class by categories
 */
function categories_to_bodyclasses($classes)
{
	$post_categories = get_the_category();
	foreach ($post_categories as $current_category) {
		$classes[] = 'category-' . $current_category->slug;
	}
   
	return $classes;
}

add_filter('body_class', 'categories_to_bodyclasses');
/**
 * Category to pages
 */
function categories_to_pages()
{
	register_taxonomy_for_object_type('post_tag', 'page');
   
	register_taxonomy_for_object_type('category', 'page');
}

add_action('init', 'categories_to_pages');
/**
 *--------------------------------------------
 * Display featured image
 */
function feat_img(array $custom = array())
{
   global $post;
   
   $defaults = array(
		'type' => 'full',
		'blur' => true,
		'classes' => array(),
		'id' => 0,
      'data' => array()
	);

	$options = array_merge($defaults, $custom);
   
   $classes = count($options['classes']) === 0 
      ? 'feat-img' 
      : implode(" ", $options['classes']) . ' feat-img';
      
   $data_attr = ''; 
   if(count($options['data']) !== 0){
      foreach($options['data'] as $data => $val){
         $data_attr .= 'data-'. $data .'="'. $val .'" ';      
      }
   } 
   
   $img_id  = $options['id'] !== 0 ? $options['id'] : $post->ID;
   
	if (has_post_thumbnail($image_id)) {
      echo '<div class="'. $classes .'" '. $data_attr .'>';

		if ($options['blur']) {
			echo '<div class="bg-placeholder-img" style="background-image: url(' . get_the_post_thumbnail_url($image_id, 'thumbnail') . ')"></div>';
		}
	  
		the_post_thumbnail($options['type'], array(
			'class' => 'feat-img-file'
		));
      
      echo '</div><!-- .feat-img -->';
	}
}

function blog_feat_img(array $custom = array())
{
   global $post;

   $defaults = array(
		'type' => 'full',
		'blur' => true,
		'classes' => array(),
      'id' => 0,
      'max_width' => '1300px'
	);

   $options = array_merge($defaults, $custom);
   
	$classes = count($options['classes']) === 0 
      ? 'feat-img' 
      : implode(" ", $options['classes']) . ' feat-img';

	$blog = get_option('page_for_posts');
   
	echo '<div class="' . $classes . '">';
	if (is_home() && $blog) {
		$image = wp_get_attachment_image_src(get_post_thumbnail_id($blog), $options['type']);
		$image_small = wp_get_attachment_image_src(get_post_thumbnail_id($blog), 'thumbnail');
		$image_srcset = wp_get_attachment_image_srcset(get_post_thumbnail_id($blog), $options['type']);

		if ($options['blur']) {
			echo '<div class="bg-placeholder-img" style="background-image: url(' . $image_small[0] . ')"></div>';
		}
	  
		echo '<img class="acf-img-file" src="' . $image[0] . '" srcset="' . $image_srcset . '" sizes="(max-width: ' . $options['max_width'] . ') 100vw, ' . $options['max_width'] . '" alt="">';
	}
	echo '</div><!-- .feat-img -->';
}


function category_feat_img($type_img = 'full', $blur = true)
{
	$fn = function_exists('category_image_src');
	$category_image = $fn ? category_image_src(array(
		'size' => $type_img
	), false) : '';
	echo '<div class="feat-img">';
	if ($blur && $fn) {
		echo '<div class="bg-placeholder-img" style="background-image: url(' . category_image_src(array(
			'size' => 'thumbnail'
		), false) . ')"></div>';
	}
   
	echo '<img class="feat-img-file" src="' . $category_image . '" alt="">';
	echo '</div><!-- .feat-img -->';
}

function acf_image($field, array $custom = array())
{
   global $post;
   
   $defaults = array(
		'type' => 'full',
		'blur' => true,
		'classes' => array(),
      'max_width' => '1300px',
      'data' => array()
	);

   $options = array_merge($defaults, $custom);
   
	$image_id = get_field($field, $post->ID);  
  
	if ($image_id) {
		$image_src = wp_get_attachment_image_url($image_id, $options['type']);
		$image_srcset = wp_get_attachment_image_srcset($image_id, $options['type']);
	  
      $classes  = count($options['classes']) === 0 
         ? 'acf-image' : 
         implode(" ", $options['classes']) . ' acf-image';
      
      $data_attr = ''; 
      if(count($options['data']) !== 0){
         foreach($options['data'] as $data => $val){
            $data_attr .= 'data-'. $data .'="'. $val .'" ';      
         }
      }  

      $image_template = '<div class="'. $classes .'" '. $data_attr .'>';
      
      if ($options['blur']) {
			$image_template .= '<div class="bg-placeholder-img" style="background-image: url(' . wp_get_attachment_image_url($image_id, 'thumbnail') . ')"></div>';
      }
      
		$image_template .= '<img class="acf-img-file" src="' . $image_src . '" srcset="' . $image_srcset . '" sizes="(max-width: ' . $options['max_width'] . ') 100vw, ' . $options['max_width'] . '" alt="">';

		$image_template .= '</div><!-- .acf-image -->';
	  
		echo $image_template;
	}
}

/**
 *--------------------------------------------
 * Wrap <img> in div
 */

function post_img_unwrap($post, $query)
{
	$img_regex = '/(<img.*?>)/s';
	$img_template = '<div class="post-img centered">$1</div>';

	$fig_regex = '/(<figure.*?>)/s';
	$fig_template = '<figure class="wp-caption">';

	$post->post_content = apply_filters('the_content', $post->post_content);
   
	$post->post_content = preg_replace($img_regex, $img_template, $post->post_content);
	$post->post_content = preg_replace($fig_regex, $fig_template, $post->post_content);
   
	return $post;
}

add_filter('the_post', 'post_img_unwrap', 10, 2);

// Unwrap Images from Paragraph Tags 
function filter_ptags_on_images($content) 
{ 
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content); 
} 
	
add_filter('the_content', 'filter_ptags_on_images', 10, 2); 



function acf_img_unwrap($value, $post_id, $field)
{
	$img_template = '</p><div class="post-img">$1</div><p>';

	$value = preg_replace('/(<img.*?>)/s', $img_template, $value);

	return $value;
}

add_filter('acf/load_value/type=wysiwyg', 'acf_img_unwrap', 10, 3);
/**
 *--------------------------------------------
 * Remove empty paragraphs created by wpautop()
 * @author Ryan Hamilton
 * @link https://gist.github.com/Fantikerz/5557617
 */
function remove_empty_p($content)
{
	$content = force_balance_tags($content);
	$content = preg_replace('#<p>\s*+(<br\s*/*>)?\s* </p>#i', '', $content);
	$content = preg_replace('~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $content);

	return $content;
}

add_filter('the_content', 'remove_empty_p', 20, 1);

/**
 * Custom excerpts
 */
function wpdocs_custom_excerpt_length($length)
{
	return 27;
}
add_filter('excerpt_length', 'wpdocs_custom_excerpt_length', 999);

function wpdocs_excerpt_more($more)
{
	$more = (get_locale() == 'es_ES') ? 'Leer más' : 'Read more' ;

	return '&hellip; <span class="read-more">' . $more .'<b> ></b></span>' ;
}
add_filter('excerpt_more', 'wpdocs_excerpt_more');
			  

function excerpt($txt, $limit)
{
	$txt = limit_text($txt, $limit);

	return '<p>'. strip_tags($txt) .'&hellip;</p>' ;
}

/**
 * Get first paragraph from a give text. * * @return String
 */
function get_the_first_paragraph($txt='', $limit='', $hellip=false)
{
	global $post;
	$txt = ('' == $txt) ? get_the_content() : $txt;
	$str = wpautop($txt);
	$str = ('' != $limit && $limit> 0)
	  ? limit_text($str, $limit)
	  : substr($str, 0, strpos($str, '</p>') + 4);
	$str = strip_tags($str);

	return ($hellip)
	  ? '<p>'. rtrim($str, '/[.,]/ \t\n') .'&hellip;</p>'
	  : '<p>'. $str .'</p>';
}

function the_first_paragraph($txt = '', $limit = 0, $hellip = false)
{
	echo get_the_first_paragraph('', $limit, $hellip);
}

/**
 *
* limit text by words
*/
function limit_text($text, $limit)
{
   if (str_word_count($text, 0) > $limit) {
      $words = str_word_count($text, 2);
      $pos = array_keys($words);
      $text = substr($text, 0, $pos[$limit]);
   }

   return $text;
}

/**
*
* Simple category title
*/
function get_category_title($title)
{
   if (is_category()) {
      $title = single_cat_title('', false);
   } elseif (is_subcategory()) {
      $title = single_cat_title('', false);
   } elseif (is_tag()) {
      $title = single_tag_title('', false);
   } elseif (is_author()) {
      $title = '<span class="vcard">' . get_the_author() . '</span>';
   }

   return $title;
}


function is_subcategory($cat_id = null)
{
   if (!$cat_id) {
      $cat_id = get_query_var('cat');
   }

   return (bool) (get_category($cat_id)->category_parent > 0);
}

add_filter('get_the_archive_title', 'get_category_title');
/**
* Extend WordPress search to include custom fields
*
* https://adambalee.com
*
* Join posts and postmeta tables
*
* http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
*/
function cf_search_join($join)
{
   global $wpdb;
   if (is_search()) {
      $join .= ' LEFT JOIN '. $wpdb->postmeta .' ON '. $wpdb->posts .'.ID = '. $wpdb->postmeta .'.post_id ';
   }

   return $join;
}

add_filter('posts_join', 'cf_search_join');

/**
 * Modify the search query with posts_where
*
* http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
*
*/
function cf_search_where($where)
{
   global $pagenow, $wpdb;
   if (is_search()) {
      $where = preg_replace("/\(\s*" . $wpdb->posts .
".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/", "(" . $wpdb->posts . ".post_title LIKE $1)
   OR (" . $wpdb->postmeta . ".meta_value LIKE $1)", $where);
   }

   return $where;
}

add_filter('posts_where', 'cf_search_where');

/**
 * Prevent duplicates
*
* http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
*/
function cf_search_distinct($where)
{
   global $wpdb;
   if (is_search()) {
      return "DISTINCT";
   }

   return $where;
}

add_filter('posts_distinct', 'cf_search_distinct');


/**
 *--------------------------------------------
* Form builder
*
* @return DOM Element
*/
function build_form(array $f_options = array())
{
   $default_options = array(
      'form_id' => 'form',
      'form_action' => 'post',
      'form_class' => 'standard-form',
      'form_attr' => array(),
      'form_after' => null,
      'form_before' => null,
      'form_field' => 'form-field',
      'fields' => array(
         array(
            'type' => 'text',
            'name' => 'name',
            'placeholder' => 'Name'
         ),
         array(
            'type' => 'email',
            'name' => 'email',
            'placeholder' => 'E-Mail'
         ),
         array(
            'type' => 'textarea',
            'name' => 'message',
            'placeholder' => 'Message'
         )
      ),
      'field_container' => false,
      'required' => true,
      'submit_value' => 'Send',
      'submit_class' => 'form-submit'
   );

   $options = array_merge($default_options, $f_options);

   $form_attr = count($options['form_attr']) > 0
      ? join(' ', $options['form_attr'])
      : '';

   $form = '<form id="' . $options['form_id'] .'" action="'. $options['form_action'] .'"
      class="'. $options['form_class'] .'"'. $form_attr .'>';

   if ($options['form_before']) {
      $form .= $options['form_before'];
   }

   foreach ($options['fields'] as $field) {
	  $input_field = '';

      if ($options['field_container']) {
         $input_field .= '<div class="field-container '. $options['field_container'] .'">';
      }

      if ($field['label']) {
         $input_field .= '<label for="'. $field['name'] .'">'. $field['label'] .'</label>';
      }
     
      if($field['type'] == 'textarea') $input_field .= '<textarea ';
      elseif($field['type'] == 'select') $input_field .= '<select ';
      else $input_field .= ' <input type="'. $field['type'] .'"';
      
      $input_field .= ' id="'. $field['name'] .'"';
      $input_field .= ' name="'. $field['name'] .'"';
      $input_field .= ' class="'. $options['form_field'] .' '. $field['class'] .'"';

      if ($field['placeholder']) {
         $input_field .=' placeholder="' . $field['placeholder'] . '"';
      }

      if ($options['required']) {
         $input_field .=' required';
      }

		if($field['type'] == 'textarea') $input_field .= '></textarea>';

		elseif($field['type'] == 'select') {
			$input_field .= '>';

			foreach($field['options'] as $option_tag) {
				$disabled = $option_tag['disabled'] ? 'disabled' : '';
				$selected = $option_tag['selected'] ? 'selected' : '';
				$input_field .= $option_tag['value'] 
					? '<option value="'. $option_tag['value'] .'"'. $disabled .' '. $selected .'>' 
					: '<option value=""'. $disabled .' '. $selected .'>';
				$input_field .= $option_tag['text'];
				$input_field .= '</option>';
			}

			$input_field .= '</select>';

		}else $input_field .= '/>';
      
      if ($options['field_container']) {
         $input_field .='</div><!-- .field-container -->';
      }

      if ($options['form_after']) {
         $form .= $options['form_after'];
      }
      
      $form .= $input_field;
   }

   $form .='<input class="human" type="text" tabindex="-1" style="background:transparent;border:none;height:0;pointer-events:none;visibility:hidden;width:0;"/>';
   $form .='<input type="submit" class="'. $options['submit_class'] .'" value="'. $options['submit_value'] .'">';
   
   $form .='</form><!-- #'. $options['form_id'] .' -->';

   return $form;
} 
//--------------------------------------------------------------
/**
 * Link to go back in browsser history
 */

function go_back_link( $content, array $classes=array()) 
{
   $classes = count($classes) === 0 
      ? 'go-back-link' 
      : implode(" ", $classes) . ' go-back-link' ;
   $previous = "javascript:history.go(-1)";
   
   if (isset( $_SERVER['HTTP_REFERER'])) {
      $previous=$_SERVER['HTTP_REFERER'];
   }

   return '<a href="' . $previous .'" class="'. $classes .'">'. $content . '</a>';
}
//--------------------------------------------------------------
/**
 * create custom post type
 */
function ph_create_custom_post_types($post_types)
{
	add_action('init', function () {
		global $post_types;
	  
		if ($post_types) {
			foreach ($post_types as $cpt) {
				$cpt['position'] = array_search($cpt, $post_types) + 5;
				create_custom_post_type($cpt);
			}
		}
	}, 0);
}

function create_custom_post_type(array $args = array())
{
	$defaults = array(
		'singular_name'      => 'Custom Post',
		'general_name'       => 'Custom Posts',
		'slug'               => null,
		'position'           => 0,
		'description'        => '',
		'menu_icon'           => 'dashicons-admin-post'
	);

	$options = array_merge($defaults, $args);

	$theme_name = get_theme_text_domain();
 
	$labels = array(
		'name'                => _x($options['general_name'], 'Post Type General Name', $theme_name),
		'singular_name'       => _x($options['singular_name'], 'Post Type Singular Name', $theme_name),
		'menu_name'           => __($options['general_name'], $theme_name),
		'parent_item_colon'   => __('Post Padre', $theme_name),
		'all_items'           => __('Todos los Posts', $theme_name),
		'view_item'           => __('Ver Post', $theme_name),
		'add_new_item'        => __('Añadir nuevo Post', $theme_name),
		'add_new'             => __('Añadir nuevo', $theme_name),
		'edit_item'           => __('Editar Post', $theme_name),
		'update_item'         => __('Actualizar Post', $theme_name),
		'search_items'        => __('Buscar Post', $theme_name),
		'not_found'           => __('No se encontró', $theme_name),
		'not_found_in_trash'  => __('No se encontró en la Papelera', $theme_name),
	);
		
	$args = array(
		'label'               => __($options['general_name'], $theme_name),
		'description'         => __($options['description'], $theme_name),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'custom-fields'),
		'taxonomies'          => array( 'category' ),
		'public'             => true,
		'show_in_rest'       => true,
		'menu_position'      => $options['position'],
		'menu_icon'          => $options['menu_icon'],
		'has_archive'        => true,
	);

	$custom_post_type_name = $options['slug']
	  ? $options['slug']
	  : sanitize_title($options['singular_name']);

	register_post_type($custom_post_type_name, $args);
}

