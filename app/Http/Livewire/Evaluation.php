<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Evaluation extends Component
{
    public $evaluation, $topic, $start_date, $end_date, $employee, $department, $score;
    public $updateMode = false;
    public $inputs = [];
    public $i = 1;
    

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;       
        array_push($this->inputs ,$i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i-2]);
        $this->mount();
$this->render();
    }

    public function render()
    {
        $this->evaluation = DB::table('company_evaluation')
        ->leftJoin('practical_evaluation', 'practical_evaluation.companye_id', '=', 'company_evaluation.ID')
        ->where('company_evaluation.student_id','=',$this->id)
        ->get();

        return view('livewire.evaluation',['inputs'=>$this->inputs]);
    }

    private function resetInputFields(){
        $this->topic = '';
        $this->start_date = '';
        $this->end_date = '';
        $this->employee = '';
        $this->department = '';
        $this->score = '';
    }

    public function store()
    {
        foreach ($this->topic as $key => $value) {
            DB::table('company_evaluation')->insert
            (['topic' => $this->topic[$key], 
            'start_date' => $this->start_date[$key],
            'end_date' => $this->end_date[$key],
            'employee' => $this->employee[$key],
            'department' => $this->department[$key],
            'score' => $this->score[$key],
        ]);
        }
  
        $this->inputs = [];
   
        $this->resetInputFields();
   
        session()->flash('message', 'Contact Has Been Created Successfully.');
    }
}
