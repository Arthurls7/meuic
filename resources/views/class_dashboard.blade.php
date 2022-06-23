@extends('basic_component')

@section('page content')

@php
 
$listaMeses = array();

foreach ($listaAtvs as $lista){
   
   $mes = ucfirst($lista->mes_atividade);
   $ano = $lista->ano_atividade;
   $mes_ano = $mes." ".$ano;

   if (array_key_exists($mes_ano,$listaMeses)){

       $listaMeses[$mes_ano][count($listaMeses[$mes_ano])+1] = $lista;
   }else{
       $listaMeses[$mes_ano] = [];
       $listaMeses[$mes_ano][0] = $lista;

   }
};

@endphp

@include('partials/feedback_basic_alert')

<div class="container"> 
    <div class="row align-items-center py-4">
        <div class="col-2" style="width: min-content;">
            <a href="/home">
                <button type="button" class="btn btn-dark material-icons">
                    arrow_back
                </button>
            </a>
        </div>
        <div class="col-10 col-md-11">
            <!-- Tratar o retorno do save e jogar aqui -->      
            <h4 class="m-0 mb-1 row discipline-name">
                Atividades 
            </h4>
        </div>
    </div>
            
    <!-- Dropdowns de professor -->
    @if(Auth::user()->user_role == 'T')
    <div class="row align-items-top">
        <div class="col-12 col-md-5">
            <div class="form-floating mb-4">
                <select class="form-select slot-1 dropdown" id="inputGroupDisciplina">
                    <option value="1" selected>Programação 1</option>
                    <option value="2">Estrutura de Dados</option>
                    <option value="3">Projeto e Análise de Algoritmos</option>
                </select>
                <label for="inputGroupDisciplina" class="align-items-center labelInput">Disciplina</label>
            </div>
        </div>
        <div class="col-12 col-md-5">
            <div class="form-floating mb-4">
                <select class="form-select slot-1 dropdown" id="inputGroupMonitor">
                    <option value="1" selected> Sônia </option>
                    <option value="2"> Letícia </option>
                    <option value="3"> Amélia </option>
                </select>    
                <label for="inputGroupMonitor" class="align-items-center labelInput">Monitor(a)</label>
            </div>
        </div>
    @endif

        @if(Auth::user()->user_role == 'T')
        <div class="col-12 col-md-2">
            <button class="btn main-button blue" type="button" data-toggle="modal" data-target="#registraAtividadeModal">
                <div class="icon-sm">
                    event
                </div>
                Registrar Atividades
            </button>
        </div>
        @elseif(Auth::user()->user_role == 'M')
        <div class="row d-flex justify-content-end">
            <div class="col-12 col-md-2">
                <button class="btn main-button blue" type="button" data-toggle="modal" data-target="#registraAtividadeModal">
                    <div class="icon-sm">
                        event
                    </div>
                    Registrar Atividades
                </button>
            </div>
        </div>
        @endif
    </div>
                   
        @foreach($listaMeses as $mesano=>$listaAtividades)

            @php
            $nomecampo = $mesano; 
            $mesano = str_replace(" ","_",$mesano);
            
            @endphp
        
            <div class="d-flex justify-content-center">
                <div class="col-8">
                    <div class="group">
                        <div class="groupslot-header slot-1" data-toggle="collapse" data-target="#{{$mesano}}, #{{$mesano}}1, #{{$mesano}}2">
                            <div class="groupslot-header-card slot-card slot-card-1 dark">
                                <h4 class="header-title" id="mes_atividade">{{$nomecampo}}</h4>
                                <h4 id="{{$mesano}}1" class="icon-sm collapse">expand_more</h4>
                                <h4 id="{{$mesano}}2" class="icon-sm collapse show">expand_less</h4>
                            </div>
                        </div>
                        
                        <div id="{{$mesano}}" class="collapse" aria-labelledby="{{$mesano}}">
                            <div class="groupslot">
                                
                                <div class="col-8 col-md-12 slot-card light-gray" style="justify-content: left !important;">
                                    
                                    <ul>
                                        @foreach($listaAtividades as $atividades)
                                        <li style="text-align: left;">{{$atividades->dia_atividade}}/{{$atividades->mes_atividade}} - {{$atividades->desc_atividade}} ({{$atividades->hora_gasto}}h{{$atividades->min_gasto}}min)
                                        </li>
                                        @endforeach
                                    </ul>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                </div>  
            </div>               
        
        @endforeach
        
    </div>
</div>

@include('partials/create_activity_modal')
    
@stop