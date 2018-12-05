<?php
/**
 * Created by PhpStorm.
 * User: Hasak
 * Date: 01.01.2019.
 * Time: 12:10
 */
?>

@extends('sablon')
@section('title')Sklapalica @endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="starter-template">
                <h1 class="display-4"><span class="fas fa-puzzle-piece fa-fw"></span> Sklapalica</h1>
                <p class="lead">U Sklapalici sklopite ili rasklopite artikle</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link tabss" id="sklopi-tab" data-toggle="tab" href="#sklopi" role="tab"
                       aria-controls="sklopi" aria-selected="true">
                        <span class="fas fa-plus"></span> Sklopi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tabss active" id="sklopljeno-tab" data-toggle="tab" href="#sklopljeno" role="tab"
                       aria-controls="sklopljeno" aria-selected="false">
                        <span class="fas fa-puzzle-piece"></span> Sklopljeno
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tabss" id="rasklopi-tab" data-toggle="tab" href="#rasklopi" role="tab"
                       aria-controls="rasklopi" aria-selected="false">
                        <span class="fas fa-times"></span> Rasklopi
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="sklopi" role="tabpanel" aria-labelledby="sklopi-tab">
                    <h2 class="phut"><span class="fas fa-plus"></span> Sklopi</h2>
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-danger alert-dismissible nd" role="alert" id="alrtgrska">
                                <strong><span class="fas fa-exclamation-triangle"></span> Greška</strong> Desila se greška prilikom dodavanja u bazu<br>
                                Error: <span id="greskadodavanja"></span>
                                <button type="button" class="close closee" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="alert alert-success alert-dismissible nd" role="alert" id="alrt-dobar">
                                <strong><span class="fas fa-check"></span> Dodano</strong><br>
                                <span id="kojijedodan" class="font-italic"></span><br>
                                <span id="ajaksresp"></span>
                                <button type="button" class="close closee" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="formica2" action="/sklopi" method="post">
                                {{csrf_field()}}
								<input type="hidden" name="ukol" id="ukol" value="0">
                                <div class="form-row align-items-center row mb-5">
                                    <div class="col-8">
                                        <input type="text" id="imee" name="imee" class="form-control form-control-lg font-weight-bold"
                                               placeholder="Naziv" required>
                                    </div>
                                    <div class="col-4">
                                        <div class="input-group">
                                            <input type="number" id="cjna" name="cjna" min="0" step="0.01"
                                                   class="form-control form-control-lg" placeholder="Cijena" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text"><span data-toggle="tooltip"
                                                                                     data-placement="top"
                                                                                     title="Konvertibilna Marka">KM</span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="zadodatt">

                                </div>
								<div id="sakriveno" class="d-none">
									<div class="row mb-2">
										<div class="col-1 nd text-center">
											<span class="fas fa-times ptr text-danger ftlgr w-100 brbtnspan"></span>
										</div>
										<div class="col-7 nd">
											<select name="artical" class="custom-select ptr jqqq form-control-sm maliselect mb-2 select-artikla" data-jel="0">
												<option value="" class="d-none" selected disabled>Artikal...
												</option>
												@foreach($sk as $a)
													<option value="{{$a->id}}" class="select-art"
															data-steps="{{$a->mj->steps}}"
															data-mjid="{{$a->mj->id}}"
															data-dugamj="{{$a->mj->ime}}"
															data-mjjd="{{$a->mj->skracenica}}">{{$a->ime}}</option>
												@endforeach
											</select>
										</div>
										<div class="col-4 nd">
											<label class="sr-only" for="inlineFormInputGroup">Količina</label>
											<div class="input-group">
												<input type="number" min="0" value="" step="{{$sk[0]->mj->steps}}" name="k"
													   class="form-control form-control-sm toax klcn" placeholder="Količina">
												<div class="input-group-append">
                                                    <span class="input-group-text form-control-sm mjernajedtext"
														  data-mjid="{{$sk[0]->mj->id}}" data-toggle="tooltip"
														  data-placement="top"
														  title="{{$sk[0]->mj->ime}}">{{$sk[0]->mj->skracenica}}</span>
												</div>
											</div>
										</div>
									</div>
								</div>
                                <div class="form-row align-items-center row mt-4 mb-5">
                                    <div class="col clearfix">
                                        <div class="float-right">
                                            <button onclick="window.location.reload()" id="rstbtnmdl" class="btn btn-secondary"><span
                                                        class="fas fa-undo"></span> Refresh
                                            </button>
                                            <button type="submit" id="sbtrr" class="btn btn-primary"><span
                                                        class="fas fa-save"></span> Sačuvaj
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show active" id="sklopljeno" role="tabpanel" aria-labelledby="sklopljeno-tab">
                    <h2 class="phut"><span class="fas fa-puzzle-piece"></span> Sklopljeno</h2>
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-warning alert-dismissible nd alrtrfs" role="alert">
                                <strong><span class="fas fa-redo fa-rotate-90"></span> Oprez!</strong> Ne zaboravite <a class="alert-link" href="">osvježiti</a>
                                stranicu da bi se vidjele izmjene
                            </div>
                            <table class="table table-hover ntb">
                                <thead>
                                <tr>
                                    <th><span class="fas fa-hashtag"></span> ID</th>
                                    <th><span class="fas fa-file-signature"></span> Ime</th>
                                    <th><span class="fas fa-ellipsis-v"></span> Sastojci</th>
                                    <th class="text-right"><span class="fas fa-dollar-sign"></span> Cijena</th>
                                    <th class="text-right"><span class="fas fa-cubes"></span> Moguće napraviti</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pz as $p)
                                    @php $totc=0; $khm=false; @endphp
                                    <tr>
                                        <td>{{$p->id}}</td>
                                        <td>{{$p->ime}}</td>
                                        <td>
                                            @foreach($skl as $s)
                                                @if($s->idpuzle==$p->id)
                                                    @php $totc+=$pcjn[$s->art->id]; if($khm) $mn=min($mn,$kol[$s->art->id]/$s->kolicina); else {$mn=$kol[$s->art->id]/$s->kolicina; $khm=true;} @endphp
                                                    {{$s->art->ime}} · {{$s->kolicina}} <span
                                                            class="font-italic" data-toggle="tooltip"
                                                            data-placement="top"
                                                            title="{{$s->art->mj->ime}}">{{$s->art->mj->skracenica}}</span>
                                                    · <span class="text-secondary mali">{{number_format($pcjn[$s->art->id],2,",",".")}} <span
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Konvertibilna Marka">KM</span></span>
                                                    <br>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="text-right">{{number_format($p->cijena,2,",",".")}} <span
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Konvertibilna Marka">KM</span> <span
                                                    class="text-secondary mali"> · {{number_format($totc,2,",",".")}} <span
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="Konvertibilna Marka">KM</span></span>
                                        </td>
                                        <td class="text-right">
                                            {{number_format($mn,0)}} <span class="font-italic" data-mjid="{{$mj[0]->id}}" data-toggle="tooltip"
                                                                             data-placement="top"
                                                                             title="{{$mj[0]->ime}}">{{$mj[0]->skracenica}}</span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="rasklopi" role="tabpanel" aria-labelledby="rasklopi-tab">
                    <h2 class="phut"><span class="fas fa-times"></span> Rasklopi</h2>
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-warning alert-dismissible nd alrtrfs" role="alert">
                                <strong><span class="fas fa-redo fa-rotate-90"></span> Oprez!</strong> Ne zaboravite <a class="alert-link" href="">osvježiti</a>
                                stranicu da bi se vidjele izmjene
                            </div>
                            <table class="table table-hover ntb">
                                <thead>
                                <tr>
                                    <th><span class="fas fa-hashtag"></span> ID</th>
                                    <th><span class="fas fa-file-signature"></span> Ime</th>
                                    <th class="text-right"><span class="fas fa-dollar-sign"></span> Cijena</th>
                                    <th class="text-right"><span class="fas fa-times"></span> Rasklopi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pz as $p)
                                    <tr class="rstred" data-redidzab="{{$p->id}}">
                                        <td>{{$p->id}}</td>
                                        <td>{{$p->ime}}</td>
                                        <td class="text-right">{{number_format($p->cijena,2,",",".")}} <span data-toggle="tooltip"
                                                                                    data-placement="top"
                                                                                    title="Konvertibilna Marka">KM</span>
                                        </td>
                                        <td class="text-right">
                                            <button class="btn btn-danger rstbtn" data-idzab="{{$p->id}}"><span
                                                        class="fas fa-times"></span> Rasklopi
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection