<?php
namespace App\Services;


class PaginationService {

  public static function extract($request)
  {
    return [
      "total" => $request->total(),
      "per_page" => $request->perPage(),
      "current_page" => $request->currentPage(),
      "last_page" => $request->lastPage(),
    ];
  }
}
