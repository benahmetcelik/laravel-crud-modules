<?php

namespace Modules\Module\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Crud\Traits\BaseCrud;
use Illuminate\Support\Facades\Artisan;

class ModuleController extends Controller
{


    use BaseCrud;

    public function __construct()
    {
        $this->base_dir = 'backend.pages.';
        $this->base_model = 'Modules\Module\Entities\Module';
        $this->base_resource = 'backend.module.';
        $this->tableColumns = ['0'=>['name'=>'title','type'=>'text','label'=>'Başlık','placeholder'=>'','required'=>'','multiple'=>'',]];
        $this->formInputs = ['0'=>['name'=>'Başlık','column'=>'title','type'=>'text',]];
        $this->tableActions = [
            'edit' => [
                'type' => 'link',
                'route' => 'backend.module.edit',
                'icon' => 'fa fa-edit',
                'class' => 'btn btn-primary btn-sm',
            ],
            'delete' => [
                'type' => 'form',
                'method' => 'delete',
                'route' => 'backend.module.destroy',
                'icon' => 'fa fa-trash',
                'class' => 'btn btn-danger btn-sm',
            ],
            'show' => [
                'type' => 'link',

                'route' => 'backend.module.show',
                'icon' => 'fa fa-eye',
                'class' => 'btn btn-success btn-sm',
            ],
        ];

        $this->formDetails = [
            'create' => [
                'title' => translate('backend', 'Create') . ' Module',
                'action' => route('backend.module.store'),
                'method' => 'POST',
                'submit' => translate('backend', 'Create'),
                'formName' => 'create',
                'formCancelText' => translate('backend', 'Cancel'),
                'formCancelRoute' => route('backend.module.index'),
                'formCancelClass' => 'btn btn-danger',
                'formSubmitClass' => 'btn btn-primary',
                'formSubmitIcon' => 'fa fa-save',
                'formCancelIcon' => 'fa fa-times',
                'formTitleIcon' => 'fa fa-plus',
                'formTitleClass' => 'text-primary',
                'formClass' => 'form-horizontal',
                'formId' => 'form',
                'formEnctype' => 'multipart/form-data',
            ],
            'edit' => [
                'formName' => 'edit',
                'title' => translate('backend', 'Edit') . ' Module',
                'action' => route('backend.module.update', 1),
                'method' => 'put',
                'submit' => translate('backend', 'Update'),
                'cancel' => translate('backend', 'Cancel'),
                'formCancelText' => translate('backend', 'Cancel'),
                'formCancelRoute' => route('backend.module.index'),

                'formCancelClass' => 'btn btn-danger',
                'formSubmitClass' => 'btn btn-primary',
                'formSubmitIcon' => 'fa fa-save',
                'formCancelIcon' => 'fa fa-times',
                'formTitleIcon' => 'fa fa-edit',
                'formTitleClass' => 'text-primary',
                'formClass' => 'form-horizontal',
                'formId' => 'form',
                'formEnctype' => 'multipart/form-data',
            ],
            'show' => [
                'formName' => 'create',
                'title' => translate('backend', 'Show') . ' Module',
                'action' => route('backend.module.update', 1),
                'method' => 'put',
                'submit' => 'Update',
                'cancel' => translate('backend', 'Cancel'),
                'formCancelText' => translate('backend', 'Cancel'),
                'formCancelRoute' => route('backend.module.index'),
                'formCancelClass' => 'btn btn-danger',
                'formSubmitClass' => 'btn btn-primary',
                'formSubmitIcon' => 'fa fa-save',
                'formCancelIcon' => 'fa fa-times',
                'formTitleIcon' => 'fa fa-edit',
                'formTitleClass' => 'text-primary',
                'formClass' => 'form-horizontal',
                'formId' => 'form',
                'formEnctype' => 'multipart/form-data',
            ],
        ];

    }

    public function create()
    {
        return view('module::create');
    }

    public function store(Request $request)
    {
          print_r($request->toArray());
        $form_inputs = [];
        $table_columns = [];
        $show_table = [];
        $module_id = rand(1, 1000);
        $model_name = $request->post('module_name').$module_id ?? 'Module'.$module_id;
        $model_name = ucfirst($model_name);
        $modul_name = $request->post('module_name').$module_id ?? 'Module'.$module_id;
        $modul_name = ucfirst($modul_name);

        $column_names = [];
        foreach ($request->post('column') as $key => $value) {
            $table_columns[] = [
                'name' => $value,
                'type' => $request->post('type')[$key] ?? 'string',
                'length' => $request->post('length')[$key] ?? 255,
                'default' => $request->post('default')[$key] ?? null,
                'nullable' => $request->post('isNull')[$key] ?? false,
            ];
            $column_names[] = $value;
        }
        foreach ($request->post('inputType') as $key => $value) {
            $form_inputs[] = [
                   'name' => $request->post('inputColumn')[$key],
                'type' => $value,
                'label' =>$request->post('inputName')[$key] ?? null,
                'placeholder' => $request->post('inputPlaceholder')[$key] ?? null,
                'required' => $request->post('inputRequired')[$key] ?? false,
                'multiple' => $request->post('inputMultiple')[$key] ?? false,

            ];
        }
        foreach ($request->post('showTable') as $key => $value) {
            $show_table[] = [
               'name' => $request->post('inputName')[$key] ?? 'Tanımsız',
                'column' => $request->post('inputColumn')[$key] ?? 'id',
                'type' => $request->post('inputType')[$key] ?? 'text',
            ];
        }

         Artisan::call('module:make '.$modul_name);
       Artisan::call('module:make-model '.$modul_name.' '.$model_name.' -m --fillable="'.implode(',',$column_names).'"');

        $migration_name_explode = preg_split('/(?=[A-Z])/',$modul_name);
        if (count($migration_name_explode) > 1) {
            $migration_name = implode('_', $migration_name_explode);
        } else {
            $migration_name = $modul_name;
        }
        $migration_name = ltrim(strtolower($migration_name), '_');



        $migration_file = base_path('Modules/'.$modul_name.'/Database/Migrations/'.date('Y_m_d_His').'_create_'.$migration_name.'s_table.php');
        $model_file = base_path('Modules/'.$modul_name.'/Entities/'.$model_name.'.php');
        $controller_file = base_path('Modules/'.$modul_name.'/Http/Controllers/'.$model_name.'Controller.php');
        $this->rewriteMigrationFile($migration_file, $table_columns,$modul_name);

       // $this->rewriteModelFile($model_file, $form_inputs,$modul_name);
        $this->rewriteControllerFile($controller_file, $show_table,$form_inputs,$modul_name,$model_name);

        Artisan::call('module:migrate '.$modul_name);
        Artisan::call('optimize:clear');
        echo 'Module Created';
        return redirect()->route('backend.module.index');


    }
    public function rewriteMigrationFile($file, $table_columns,$module_name)
    {



            $file_content = file_get_contents($file);

        foreach ($table_columns as $key => $value) {
            $file_content = str_replace('$table->timestamps();', '$table->timestamps();
            $table->'.$value['type'].'(\''.$value['name'].'\')->nullable();', $file_content);
        }
        $file_content = str_replace('});', '});', $file_content);
        file_put_contents($file, $file_content);
       // Artisan::call('module:migrate '.$module_name);
    }

    public function rewriteModelFile($file, $table_columns,$model_name)
    {
        $file_content = file_get_contents($file);
        $file_content = str_replace('class '.$model_name.' extends Model', 'class '.$model_name.' extends Model
    {
        protected $table = \''.strtolower($model_name).'s'.'\';
        protected $fillable = [\''.implode('\',\'', array_column($table_columns, 'name')).'\'];
        ', $file_content);
        file_put_contents($file, $file_content);
    }


    public function rewriteControllerFile($file,$table_columns,$form_inputs,$show_table)
    {
        $file_content = file_get_contents($file);

       $print_r_to_array_table_columns = rtrim($this->array_to_return_string($table_columns),',');
       $print_r_to_array_form_inputs = rtrim($this->array_to_return_string($form_inputs),',');

        $file_content = str_replace('$this->tableColumns = [];
        $this->formInputs = [];', '$this->tableColumns = '.$print_r_to_array_table_columns.';
        $this->formInputs = '.$print_r_to_array_form_inputs.';', $file_content);
        file_put_contents($file, $file_content);
    }
    protected function array_to_return_string($param) {
        $str="[";
        if($param){
            foreach ($param as $key => $value) {
                if(is_array($value) && $value){
                    $strx=$this->array_to_return_string($value);
                    $str.="'$key'=>$strx";
                }else{
                    $str.="'$key'=>'$value',";
                }
            }
        }
        $str.="],";
        return $str;
    }


}
