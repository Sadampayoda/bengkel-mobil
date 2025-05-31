<?php 

use App\Interface\TableInterface;
include __DIR__.'/../interface/tableInterface.php';



class TableRepository implements TableInterface {
    protected $title,$values,$edit,$delete, $action,$print;
    public function __construct($title,$value,$edit,$delete,$action=true,$print='')
    {
        $this->title = $title;
        $this->values = $value;
        $this->edit = $edit;
        $this->delete = $delete;
        $this->action = $action;
        $this->print = $print;
    }
    public function title()
    {
        return $this->title;
    }

    public function value()
    {
        return $this->values;
    }

    public function entry()
    {
        return isset($_GET['entry']) ? $_GET['entry'] : 5;
    }

    public function paginate()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $count = (count($this->values ?? [])) / $this->entry();
        $view = $this->entry() *  $page ; 
        $prev = $page <= 1 ? true : false;
        $next = $page >= $count ? true : false;
        return [
            'count' => $count,
            'view' => $view - $this->entry(),
            'page' => $page ?? 1,
            'prev' => $prev,
            'next' => $next,
            'summary' => $view - $this->entry() + 1 . ' to ' . $view . ' of '. count($this->values ?? []).' entries' ,
        ];

    }

    public function clickEdit()
    {
        return $this->edit ?? null;
    }

    public function clickDelete()
    {
        return $this->delete ?? null;
    }

    public function action()
    {
        return $this->action;
    }

    public function print()
    {
        return $this->print ?? null;
    }

}
