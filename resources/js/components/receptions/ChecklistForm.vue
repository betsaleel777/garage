<template>
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-4">
				<h5 class="text-primary">Checklist</h5>
			</div>
			<div style="text-align: right" class="col-md-8">
				<span class="text-muted">{ I: inexistant , B: bon, P: passable, M: mauvais }</span>
			</div>
		</div>
		<hr />
		<table class="table table-bordered">
			<thead>
				<tr>
					<th style="width: 56%">Compartiements</th>
					<th class="text-center" style="width: 1%">I</th>
					<th class="text-center" style="width: 1%">B</th>
					<th class="text-center" style="width: 1%">P</th>
					<th class="text-center" style="width: 1%">M</th>
					<th class="text-center" style="width: 40%"></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th colspan="6"><b>Intérieur</b></th>
				</tr>
				<tr>
					<td>Eclairage</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio1"
								v-model="checklist.eclairage_int"
								id="inlineRadio4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio1"
								v-model="checklist.eclairage_int"
								value="bon"
								id="inlineRadio1"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio1"
								v-model="checklist.eclairage_int"
								id="inlineRadio2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio1"
								v-model="checklist.eclairage_int"
								id="inlineRadio3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.eclairage_int.exist" class="text-danger"
								>{{ messages.eclairage_int.value }}
							</span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Rétroviseur</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio2"
								v-model="checklist.retroviseurs_int"
								id="b4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio2"
								v-model="checklist.retroviseurs_int"
								id="b1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio2"
								v-model="checklist.retroviseurs_int"
								id="b2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio2"
								v-model="checklist.retroviseurs_int"
								id="b3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.retroviseurs_int.exist" class="text-danger"
								>{{ messages.retroviseurs_int.value }}
							</span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Klaxon</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio3"
								v-model="checklist.klaxon"
								id="c4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio3"
								v-model="checklist.klaxon"
								id="c1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio3"
								v-model="checklist.klaxon"
								id="c2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio3"
								v-model="checklist.klaxon"
								id="c3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.klaxon.exist" class="text-danger">{{ messages.klaxon.value }} </span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Essuies glace</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio4"
								v-model="checklist.essuies_glace"
								id="d4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio4"
								v-model="checklist.essuies_glace"
								id="d1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio4"
								v-model="checklist.essuies_glace"
								id="d2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio4"
								v-model="checklist.essuies_glace"
								id="d3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.essuies_glace.exist" class="text-danger"
								>{{ messages.essuies_glace.value }}
							</span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Radio</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio5"
								v-model="checklist.radio"
								id="e4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio5"
								v-model="checklist.radio"
								id="e1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio5"
								v-model="checklist.radio"
								id="e2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio5"
								v-model="checklist.radio"
								id="e3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.radio.exist" class="text-danger">{{ messages.radio.value }} </span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Climatisation</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio6"
								v-model="checklist.climatisation"
								id="f4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio6"
								v-model="checklist.climatisation"
								id="f1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio6"
								v-model="checklist.climatisation"
								id="f3"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio6"
								v-model="checklist.climatisation"
								id="f2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.climatisation.exist" class="text-danger"
								>{{ messages.climatisation.value }}
							</span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Frein de stationnement</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio7"
								v-model="checklist.frein_stationnement"
								id="c4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio7"
								v-model="checklist.frein_stationnement"
								id="c1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio7"
								v-model="checklist.frein_stationnement"
								id="c2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio7"
								v-model="checklist.frein_stationnement"
								id="c3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.frein_stationnement.exist" class="text-danger"
								>{{ messages.frein_stationnement.value }}
							</span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Sièges</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio8"
								v-model="checklist.sieges"
								id="g4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio8"
								v-model="checklist.sieges"
								id="g1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio8"
								v-model="checklist.sieges"
								id="g3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio8"
								v-model="checklist.sieges"
								id="g2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.sieges.exist" class="text-danger">{{ messages.sieges.value }} </span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Tableau de bord</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio9"
								v-model="checklist.tableau_bord"
								id="h4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio9"
								v-model="checklist.tableau_bord"
								id="h1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio9"
								v-model="checklist.tableau_bord"
								id="h2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio9"
								v-model="checklist.tableau_bord"
								id="h3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.tableau_bord.exist" class="text-danger"
								>{{ messages.tableau_bord.value }}
							</span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Lève vitre</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio10"
								v-model="checklist.leve_vitre"
								id="i4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio10"
								v-model="checklist.leve_vitre"
								id="i1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio10"
								v-model="checklist.leve_vitre"
								id="i2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio10"
								v-model="checklist.leve_vitre"
								id="i3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.leve_vitre.exist" class="text-danger"
								>{{ messages.leve_vitre.value }}
							</span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Vérrouillage des portes</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio34"
								v-model="checklist.verrouillage_portes"
								id="j4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio34"
								v-model="checklist.verrouillage_portes"
								id="j1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio34"
								v-model="checklist.verrouillage_portes"
								id="j2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio34"
								v-model="checklist.verrouillage_portes"
								id="j3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.verrouillage_portes.exist" class="text-danger"
								>{{ messages.verrouillage_portes.value }}
							</span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Ouverture des portes Intérieur</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio11"
								v-model="checklist.ouverture_portes_int"
								id="k4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio11"
								v-model="checklist.ouverture_portes_int"
								id="k1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio11"
								v-model="checklist.ouverture_portes_int"
								id="k2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio11"
								v-model="checklist.ouverture_portes_int"
								id="k3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.ouverture_portes_int.exist" class="text-danger"
								>{{ messages.ouverture_portes_int.value }}
							</span>
						</small>
					</td>
				</tr>
				<tr>
					<th colspan="6"><b>Extérieur</b></th>
				</tr>
				<tr>
					<td>Roues</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio12"
								v-model="checklist.roues"
								id="q4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio12"
								v-model="checklist.roues"
								id="q1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio12"
								v-model="checklist.roues"
								id="q2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio12"
								v-model="checklist.roues"
								id="q3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.roues.exist" class="text-danger">{{ messages.roues.value }} </span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Feux arrières</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio13"
								v-model="checklist.feux_arrieres"
								id="r4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio13"
								v-model="checklist.feux_arrieres"
								id="r1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio13"
								v-model="checklist.feux_arrieres"
								id="r2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio13"
								v-model="checklist.feux_arrieres"
								id="r3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.feux_arrieres.exist" class="text-danger"
								>{{ messages.feux_arrieres.value }}
							</span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Balais e/g avant</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio35"
								v-model="checklist.balais_essuies_glace_av"
								id="s4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio35"
								v-model="checklist.balais_essuies_glace_av"
								id="s1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio35"
								v-model="checklist.balais_essuies_glace_av"
								id="s2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio35"
								v-model="checklist.balais_essuies_glace_av"
								id="s3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.balais_essuies_glace_av.exist" class="text-danger"
								>{{ messages.balais_essuies_glace_av.value }}
							</span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Balais e/g arrière</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio14"
								v-model="checklist.balais_essuies_glace_ar"
								id="t4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio14"
								v-model="checklist.balais_essuies_glace_ar"
								id="t1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio14"
								v-model="checklist.balais_essuies_glace_ar"
								id="t2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio14"
								v-model="checklist.balais_essuies_glace_ar"
								id="t3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.balais_essuies_glace_ar.exist" class="text-danger"
								>{{ messages.balais_essuies_glace_ar.value }}
							</span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Trappe à carburant</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio15"
								v-model="checklist.trape_carburant"
								id="u4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio15"
								v-model="checklist.trape_carburant"
								id="u1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio15"
								v-model="checklist.trape_carburant"
								id="u2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio15"
								v-model="checklist.trape_carburant"
								id="u3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.trape_carburant.exist" class="text-danger"
								>{{ messages.trape_carburant.value }}
							</span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Ouverture porte extérieur</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio16"
								v-model="checklist.ouverture_portes_ext"
								id="v4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio16"
								v-model="checklist.ouverture_portes_ext"
								id="v1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio16"
								v-model="checklist.ouverture_portes_ext"
								id="v2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio16"
								v-model="checklist.ouverture_portes_ext"
								id="v3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.ouverture_portes_ext.exist" class="text-danger"
								>{{ messages.ouverture_portes_ext.value }}
							</span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Rétroviseur extérieur</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio17"
								v-model="checklist.retroviseurs_ext"
								id="w4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio17"
								v-model="checklist.retroviseurs_ext"
								id="w1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio17"
								v-model="checklist.retroviseurs_ext"
								id="w2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio17"
								v-model="checklist.retroviseurs_ext"
								id="w3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.retroviseurs_ext.exist" class="text-danger"
								>{{ messages.retroviseurs_ext.value }}
							</span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Clé de contact</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio18"
								v-model="checklist.cle_contact"
								id="x4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio18"
								v-model="checklist.cle_contact"
								id="x1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio18"
								v-model="checklist.cle_contact"
								id="x2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio18"
								v-model="checklist.cle_contact"
								id="x3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.cle_contact.exist" class="text-danger"
								>{{ messages.cle_contact.value }}
							</span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Clignotants</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio19"
								v-model="checklist.clignotants"
								id="y4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio19"
								v-model="checklist.clignotants"
								id="y1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio19"
								v-model="checklist.clignotants"
								id="y2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio19"
								v-model="checklist.clignotants"
								id="y3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.clignotants.exist" class="text-danger"
								>{{ messages.clignotants.value }}
							</span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Veilleuses</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio20"
								v-model="checklist.veilleuses"
								id="z4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio20"
								v-model="checklist.veilleuses"
								id="z1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio20"
								v-model="checklist.veilleuses"
								id="z2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio20"
								v-model="checklist.veilleuses"
								id="z3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.veilleuses.exist" class="text-danger"
								>{{ messages.veilleuses.value }}
							</span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Feux de croisement</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio21"
								v-model="checklist.feux_croisement"
								id="a4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio21"
								v-model="checklist.feux_croisement"
								id="a1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio21"
								v-model="checklist.feux_croisement"
								id="a2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio21"
								v-model="checklist.feux_croisement"
								id="a3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.feux_croisement.exist" class="text-danger"
								>{{ messages.feux_croisement.value }}
							</span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Feux de récul</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio22"
								v-model="checklist.feux_recul"
								id="ab4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio22"
								v-model="checklist.feux_recul"
								id="ab1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio22"
								v-model="checklist.feux_recul"
								id="ab2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio22"
								v-model="checklist.feux_recul"
								id="ab3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.feux_recul.exist" class="text-danger"
								>{{ messages.feux_recul.value }}
							</span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Feux de stop</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio23"
								v-model="checklist.feux_stop"
								id="ac4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio23"
								v-model="checklist.feux_stop"
								id="ac1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio23"
								v-model="checklist.feux_stop"
								id="ac2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio23"
								v-model="checklist.feux_stop"
								id="ac3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.feux_stop.exist" class="text-danger"
								>{{ messages.feux_stop.value }}
							</span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Feux antibrouillard</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio24"
								v-model="checklist.feux_antibrouillard"
								id="ad4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio24"
								v-model="checklist.feux_antibrouillard"
								id="ad1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio24"
								v-model="checklist.feux_antibrouillard"
								id="ad2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio24"
								v-model="checklist.feux_antibrouillard"
								id="ad3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.feux_antibrouillard.exist" class="text-danger"
								>{{ messages.feux_antibrouillard.value }}
							</span>
						</small>
					</td>
				</tr>

				<tr>
					<td>Cric</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio25"
								v-model="checklist.cric"
								id="ae4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio25"
								v-model="checklist.cric"
								id="ae1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio25"
								v-model="checklist.cric"
								id="ae2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio25"
								v-model="checklist.cric"
								id="ae3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.cric.exist" class="text-danger">{{ messages.cric.value }} </span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Roues de secours</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio26"
								v-model="checklist.roues_secours"
								id="af4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio26"
								v-model="checklist.roues_secours"
								id="af1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio26"
								v-model="checklist.roues_secours"
								id="af2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio26"
								v-model="checklist.roues_secours"
								id="af3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.roues_secours.exist" class="text-danger"
								>{{ messages.roues_secours.value }}
							</span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Manivelles</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio27"
								v-model="checklist.manivelle"
								id="ag4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio27"
								v-model="checklist.manivelle"
								id="ag1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio27"
								v-model="checklist.manivelle"
								id="ag2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio27"
								v-model="checklist.manivelle"
								id="ag3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.manivelle.exist" class="text-danger"
								>{{ messages.manivelle.value }}
							</span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Trousses</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio28"
								v-model="checklist.trousse"
								id="ah4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio28"
								v-model="checklist.trousse"
								id="ah1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio28"
								v-model="checklist.trousse"
								id="ah2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio28"
								v-model="checklist.trousse"
								id="ah3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.trousse.exist" class="text-danger">{{ messages.trousse.value }} </span>
						</small>
					</td>
				</tr>
				<tr>
					<th colspan="6"><b>Sous le capot</b></th>
				</tr>
				<tr>
					<td>Huile de moteur</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio29"
								v-model="checklist.huile_moteur"
								id="l4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio29"
								v-model="checklist.huile_moteur"
								id="l1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio29"
								v-model="checklist.huile_moteur"
								id="l2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio29"
								v-model="checklist.huile_moteur"
								id="l3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.huile_moteur.exist" class="text-danger"
								>{{ messages.huile_moteur.value }}
							</span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Huile de frein</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio30"
								v-model="checklist.huile_frein"
								id="m4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio30"
								v-model="checklist.huile_frein"
								id="m1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio30"
								v-model="checklist.huile_frein"
								id="m2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio30"
								v-model="checklist.huile_frein"
								id="m3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.huile_frein.exist" class="text-danger"
								>{{ messages.huile_frein.value }}
							</span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Huile de direction</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio31"
								v-model="checklist.huile_direction"
								id="n4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio31"
								v-model="checklist.huile_direction"
								id="n1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio31"
								v-model="checklist.huile_direction"
								id="n2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio31"
								v-model="checklist.huile_direction"
								id="n3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.huile_direction.exist" class="text-danger"
								>{{ messages.huile_direction.value }}
							</span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Liquide de refroidissement</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio32"
								v-model="checklist.liquide_refroidissement"
								id="o4"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio32"
								v-model="checklist.liquide_refroidissement"
								id="o1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio32"
								v-model="checklist.liquide_refroidissement"
								id="o2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio32"
								v-model="checklist.liquide_refroidissement"
								id="o3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.liquide_refroidissement.exist" class="text-danger"
								>{{ messages.liquide_refroidissement.value }}
							</span>
						</small>
					</td>
				</tr>
				<tr>
					<td>Liquide lave glace</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								name="radio33"
								v-model="checklist.liquide_lave_glace"
								type="radio"
								value="inexistant"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio33"
								v-model="checklist.liquide_lave_glace"
								id="p1"
								value="bon"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio33"
								v-model="checklist.liquide_lave_glace"
								id="p2"
								value="passable"
							/>
						</div>
					</td>
					<td>
						<div style="margin-left: 30%" class="form-check form-check-inline">
							<input
								class="form-check-input"
								type="radio"
								name="radio33"
								v-model="checklist.liquide_lave_glace"
								id="p3"
								value="mauvais"
							/>
						</div>
					</td>
					<td>
						<small>
							<span v-if="messages.liquide_lave_glace.exist" class="text-danger"
								>{{ messages.liquide_lave_glace.value }}
							</span>
						</small>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
import store from "./Store"
import ValidationChecklist from "./mixins/ValidationChecklist"
export default {
	mixins: [ValidationChecklist],
	mounted() {
		this.$root.$on("reset", () => {
			this.vider()
		})
		this.$root.$on("probleme", err => {
			this.errors = err
			this.erreurs()
		})
		this.$root.$on("delete-errors", () => {
			this.vider_errors()
		})
	},
	updated() {
		store.state.checklist = this.checklist
	},
	data() {
		return {
			checklist: {
				eclairage_int: null,
				retroviseurs_int: null,
				klaxon: null,
				essuies_glace: null,
				radio: null,
				climatisation: null,
				frein_stationnement: null,
				sieges: null,
				tableau_bord: null,
				leve_vitre: null,
				verrouillage_portes: null,
				ouverture_portes_int: null,
				roues: null,
				feux_arrieres: null,
				balais_essuies_glace_av: null,
				balais_essuies_glace_ar: null,
				trape_carburant: null,
				ouverture_portes_ext: null,
				retroviseurs_ext: null,
				cle_contact: null,
				clignotants: null,
				veilleuses: null,
				feux_croisement: null,
				feux_recul: null,
				feux_stop: null,
				feux_antibrouillard: null,
				cric: null,
				roues_secours: null,
				manivelle: null,
				trousse: null,
				huile_moteur: null,
				huile_frein: null,
				huile_direction: null,
				liquide_refroidissement: null,
				liquide_lave_glace: null,
			},
		}
	},
	methods: {
		vider() {
			this.checklist = {
				eclairage_int: null,
				retroviseurs_int: null,
				klaxon: null,
				essuies_glace: null,
				radio: null,
				climatisation: null,
				frein_stationnement: null,
				sieges: null,
				tableau_bord: null,
				leve_vitre: null,
				verrouillage_portes: null,
				ouverture_portes_int: null,
				roues: null,
				feux_arrieres: null,
				balais_essuies_glace_av: null,
				balais_essuies_glace_ar: null,
				trape_carburant: null,
				ouverture_portes_ext: null,
				retroviseurs_ext: null,
				cle_contact: null,
				clignotants: null,
				veilleuses: null,
				feux_croisement: null,
				feux_recul: null,
				feux_stop: null,
				feux_antibrouillard: null,
				cric: null,
				roues_secours: null,
				manivelle: null,
				trousse: null,
				huile_moteur: null,
				huile_frein: null,
				huile_direction: null,
				liquide_refroidissement: null,
				liquide_lave_glace: null,
			}
		},
	},
}
</script>

<style></style>
