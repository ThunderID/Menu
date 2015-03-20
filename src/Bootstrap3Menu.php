<?php namespace thunderid\menu;

class Bootstrap3Menu implements IMenu {

	protected $ids = [];
	protected $options;

	function __construct($is_inverse_navbar = false, $brand_logo = null)
	{
		$this->options['is_inverse_navbar'] = ($is_inverse_navbar ? true : false);
		$this->options['brand_logo'] 		= ($brand_logo ? $brand_logo : 'Logo');

		$this->add('__left_nav', 'left_nav', '', '');
		$this->add('__right_nav', 'left_nav', '', '');
	}

	/**
	 * Add menu item
	 * @param string $id unique menu item identifier 
	 * @param IMenuItem $menu_item menu item
	 * @param string $parent_id unique parent menu item identifier
	 * @return boolean
	 * @author 
	 **/
	function add($id, $label, $url, $icon = null, $parent_id = null)
	{
		$this->ids[$id] = ['label' => $label, 'url' => $url, 'icon' => $icon];
		if ($parent_id)
		{
			if (!array_key_exists($parent_id, $this->ids))
			{
				throw new Exception('$parent_id not found', 1);
			}
			else
			{
				$this->ids[$parent_id]['children'][] = &$this->ids[$id];
				$this->ids[$id]['parent'] = &$this->ids[$parent_id];
			}
		}
	}

	/**
	 * find particular menuItem
	 *
	 * @return MenuItem|null 
	 * @author 
	 **/
	function find($id)
	{
		if (!array_key_exists($id, $this->ids))
		{
			throw new Exception('$id not found', 1);
		}
	}

	/**
	 * Render
	 * @return string
	 * @author 
	 **/
	function render()
	{
		print_r($this->ids);
		$str = '
				<nav class="navbar '. ($this->options['is_inverse_navbar'] ? 'navbar-default' : 'navbar-inverse') .'" role="navigation">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#">'.$this->options['brand_logo'].'</a>
					</div>
				
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-ex1-collapse">';

		if (array_key_exists('children', $this->ids['__left_nav']) && count($this->ids['__left_nav']['children']))
		{
			$str .= '<ul class="nav navbar-nav">';
			$str .= $this->_render($this->ids['__left_nav']);
			$str .= '</ul>';
		}

		if (array_key_exists('children', $this->ids['__right_nav']) && count($this->ids['__right_nav']['children']))
		{
			$str .= '<ul class="nav navbar-nav navbar-right">';
			$str .= $this->_render($this->ids['__right_nav']);
			$str .= '</ul>';
		}

		$str .= '	</div><!-- /.navbar-collapse -->
				</nav>';

		return $str;
	}

	protected function _render($parent_menu, $parent_id = null)
	{
		$str = '';
		if (count($parent_menu['children']))
		{
			foreach ($parent_menu['children'] as $child_menu)
			{
				$str .= '<li><a href="'.$child_menu['url'].'">' . $child_menu['label'] . '</a>';
				if (array_key_exists('children', $child_menu) && count($child_menu['children']))
				{
					$str .= $this->_render($child_menu);
				}
				$str .= '</li>';
			}
		}

		return $str;
	}

}