# Installation

# Usage

## Adding new Menu Item
```
$menu = new Menu();
$menu->add('id', $menu->newItem('label', 'link to url', 'icon'), 'parent_id')
echo $menu->render();
```

## Remove MenuItem
```
$menu->remove('id')
```