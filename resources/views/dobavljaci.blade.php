<?php
/**
 * Created by PhpStorm.
 * User: Hasak
 * Date: 31.01.2019.
 * Time: 09:05
 */
?>

@extends('sablon')
@section('title')Dobavljači @endsection
@section('content')
	<div class="row">
		<div class="col">
			<div class="starter-template">
				<h1 class="display-4"><span class="fas fa-truck fa-fw"></span> Dobavljači</h1>
				<p class="lead">Pogledajte, dodajte ili izbrišite dobavljače</p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link tabss" id="dodajd-tab" data-toggle="tab" href="#dodajd" role="tab"
					   aria-controls="dodajd" aria-selected="true">
						<span class="fas fa-plus"></span> Dodajte
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link tabss active" id="pogledajted-tab" data-toggle="tab" href="#pogledajted" role="tab"
					   aria-controls="pogledajted" aria-selected="false">
						<span class="fas fa-truck"></span> Dobavljači
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link tabss" id="izbrisid-tab" data-toggle="tab" href="#izbrisid" role="tab"
					   aria-controls="izbrisid" aria-selected="false">
						<span class="fas fa-times"></span> Izbriši
					</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade" id="dodajd" role="tabpanel" aria-labelledby="dodajd-tab">
					<h2 class="phut"><span class="fas fa-plus"></span> Dodajte</h2>
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
							<form id="formica2d" action="/sklopid" method="post">
								{{csrf_field()}}
								<div class="form-row align-items-center row mb-5">
									<div class="col-8">
										<input type="text" id="imeed" name="imeed" class="form-control"
											   placeholder="Naziv" required>
									</div>
									<div class="col-4">
										<div class="input-group">
											<input type="text" id="opisd" name="opisd"
												   class="form-control" placeholder="Opis">
										</div>
									</div>
								</div>
								<div class="form-row align-items-center row mt-4 mb-5">
									<div class="col clearfix">
										<div class="float-right">
											<button type="reset" id="rstbtnmdl" class="btn btn-secondary"><span
														class="fas fa-undo"></span> Resetuj
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
				<div class="tab-pane fade show active" id="pogledajted" role="tabpanel" aria-labelledby="pogledajted-tab">
					<h2 class="phut"><span class="fas fa-truck"></span> Dobavljači</h2>
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
									<th><span class="fas fa-truck"></span> Ime</th>
									<th><span class="fas fa-file-alt"></span> Opis</th>
									<th><span class="fas fa-user"></span> User</th>
								</tr>
								</thead>
								<tbody>
								@foreach($art as $p)
									<tr>
										<td>{{$p->id}}</td>
										<td>{{$p->ime}}</td>
										<td>{{$p->opis}}</td>
										<td>{{$p->us->username}}</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="izbrisid" role="tabpanel" aria-labelledby="izbrisid-tab">
					<h2 class="phut"><span class="fas fa-times"></span> Izbriši</h2>
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
									<th><span class="fas fa-truck"></span> Ime</th>
									<th><span class="fas fa-file-alt"></span> Opis</th>
									<th class="text-right"><span class="fas fa-times"></span> Izbriši</th>
								</tr>
								</thead>
								<tbody>
								@foreach($art as $p)
									<tr class="rstredd" data-redidzab="{{$p->id}}">
										<td>{{$p->id}}</td>
										<td>{{$p->ime}}</td>
										<td>{{$p->opis}}</td>
										<td class="text-right">
											<button class="btn btn-danger rstbtndb" data-idzab="{{$p->id}}"><span
														class="fas fa-times"></span> Izbriši
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
