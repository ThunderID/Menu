<?php namespace ThunderID\Menu;

class MaterialAdminSideMenu extends Menu implements IMenu {

	protected $ids = [];
	protected $options;

	function __construct()
	{
	}

	/**
	 * Render
	 * @return string
	 * @author 
	 **/
	function render()
	{
		$str = '<div class="menubar-scroll-panel">
					<ul id="main-menu" class="gui-controls gui-controls-tree">';

		if (count($this->ids))
		{
			foreach ($this->ids as $menu)
			{
				if (!array_key_exists('parent', $menu))
				{
					$str .= $this->_render($menu);
				}
			}
		}
			
		$str .=		'</ul>
				</div>';

		return $str;
	}

	protected function _render($parent_menu, $parent_id = null)
	{
		if (array_key_exists('children', $parent_menu) && count($parent_menu['children']))
		{
			$has_children = true;
		}
		else
		{
			$has_children = false;
		}

		$str = '<li class="'.($has_children ? 'gui-folder' : ''). '">
					<a>
						<div class="gui-icon"><i class="'.$parent_menu['icon'].'"></i></div>
						<span class="title">'.$parent_menu['label'].'</span>
					</a>';

		if ($has_children)
		{
			foreach ($parent_menu['children'] as $child_menu)
			{
				$str .= $this->_render($child_menu);
			}
		}		

		$str .= '</li>';

		return $str;
	}

}
