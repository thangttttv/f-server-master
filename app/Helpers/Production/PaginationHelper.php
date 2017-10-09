<?php
namespace App\Helpers\Production;

use App\Helpers\PaginationHelperInterface;

class PaginationHelper implements PaginationHelperInterface
{
    public function normalize($offset, $limit, $maxLimit, $defaultLimit)
    {
        if ($limit <= 0 || $limit > $maxLimit) {
            $limit = $defaultLimit;
        }
        $page   = intval($offset / $limit);
        $offset = $limit * $page;

        return [
            'limit'  => $limit,
            'offset' => $offset,
        ];
    }

    public function data(
        $offset,
        $limit,
        $count,
        $path,
        $query,
        $paginationNumber = 5
    ) {
        if (empty($query) || !is_array($query)) {
            $query = [];
        }
        $data   = $this->normalize($offset, $limit, 100, 10);
        $offset = $data['offset'];
        $limit  = $data['limit'];
        $page   = intval($offset / $limit) + 1;
        $data   = [];
        if ($page != 1) {
            $data['firstPageLink'] = $this->generateLink(1, $path, $query, $limit);
        }
        $lastPage = intval(($count - 1) / $limit) + 1;

        if ($page < $lastPage) {
            $data['lastPageLink'] = $this->generateLink($lastPage, $path, $query, $limit);
        }
        if($page > $lastPage){
            $minPage = $lastPage - intval($paginationNumber / 2);
        }else{
            $minPage = $page - intval($paginationNumber / 2);
        }
        if ($minPage < 1) {
            $minPage = 1;
        }

        $data['pageListContainFirstPage'] = $minPage == 1 ? true : false;
        $data['pageListContainLastPage']  = false;

        $data['lastPage']    = $lastPage;
        $data['currentPage'] = $page;

        $data['pages'] = [];
        $data['count'] = $count;
        for ($i = $minPage; $i < ($minPage + $paginationNumber); ++$i) {
            if ($i > $lastPage) {
                break;
            }
            $data['pages'][] = [
                'number'  => $i,
                'link'    => $this->generateLink($i, $path, $query, $limit),
                'current' => ($i == $page) ? true : false,
            ];
            if ($i == $lastPage) {
                $data['pageListContainLastPage'] = true;
            }
        }

        if($page > $lastPage){
            $data['pages'][$page] = [
                'number' => $page,
                'link' => $this->generateLink($page, $path, $query, $limit),
                'current' =>  true,
            ];
        }
        $data['previousPageLink'] = $page <= 1 ? '' : $this->generateLink($page - 1, $path, $query, $limit);
        $data['nextPageLink']     = $page >= $lastPage ? '' : $this->generateLink($page + 1, $path, $query, $limit);

        return $data;
    }

    public function render(
        $offset,
        $limit,
        $count,
        $path,
        $query,
        $paginationNumber = 5,
        $template = 'shared.pagination'
    ) {
        $data = $this->data($offset, $limit, $count, $path, $query, $paginationNumber);

        return view($template, $data);
    }

    private function generateLink($page, $path, $query, $limit)
    {
        return $path.'?'.http_build_query(array_merge($query, ['offset' => ($page - 1) * $limit, 'limit' => $limit]));
    }

    public function hasNext($count, $ofset, $limit)
    {
        if (!empty($limit) && $limit > 0 && $count > 0) {
            $currentPage = $ofset / $limit;
            $totalPage   = $count / $limit;
            if ($totalPage > $currentPage && $totalPage > 1) {
                return true;
            }
        }

        return false;
    }
}
