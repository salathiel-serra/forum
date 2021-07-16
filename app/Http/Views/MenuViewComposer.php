<?php
namespace App\Http\Views;

class MenuViewComposer {
  public function compose($view)
  {
    $roleUsers = auth()->user()->role;

    $modulesFiltered = [];
    foreach ($roleUsers->modules as $key => $module) {
      
      $modulesFiltered[$key]['name'] = $module->name;

      foreach ($module->resources as $resource) {
       if ($resource->roles->contains($roleUsers)) {
         $modulesFiltered[$key]['resources'][] = $resource;
       }
      }
    }
   
    return $view->with('modules', $modulesFiltered);
  }
}