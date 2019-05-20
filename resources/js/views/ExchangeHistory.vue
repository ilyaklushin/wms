<template>
	<v-app>
		<v-toolbar color="green" dark>
			<v-toolbar-side-icon></v-toolbar-side-icon>
			<v-spacer></v-spacer>
			<v-menu bottom offset-y>
				<template v-slot:activator="{ on }">
					<v-btn v-on="on" flat round large icon>
						<v-badge v-model="show" color="red">
							<template v-slot:badge>
								<span>2</span>
							</template>
							<v-icon>notifications</v-icon>
						</v-badge>
					</v-btn>
				</template>
				<v-list two-line>
					<v-list-tile v-for="(item, i) in items" :key="i" @click="">
						<v-list-tile-content>
							<v-list-tile-title>{{ item.title }}</v-list-tile-title>
							<v-list-tile-sub-title>{{ item.datestamp }}</v-list-tile-sub-title>
						</v-list-tile-content>
						<v-list-tile-action>
							<v-icon :color="green">arrow_forward_ios</v-icon>
						</v-list-tile-action>
					</v-list-tile>
					<v-divider
					v-if="index + 1 < items.length"
					:key="index"
					></v-divider>				
					<v-btn flat block>Очистить все</v-btn>			
				</v-list>
			</v-menu>
			<v-btn flat round>Илья</v-btn>
		</v-toolbar>
		<v-content>
			<v-container>
				<v-data-table
				:headers="headers"
				:items="exchangehistory"
				:search="search"
				hide-actions
				:pagination.sync="pagination"
				class="elevation-1"
				>
				<template v-slot:items="props">
					<td class="text-xs">{{ props.item.date }}</td>
					<td class="text-xs">{{ props.item.status }}</td>
					<td class="text-xs">{{ props.item.description }}</td>
				</template>
			</v-data-table>
			<div class="text-xs-center pt-2">
				<v-pagination v-model="pagination.page" :length="pages" circle color="green"></v-pagination>
			</div>
		</v-container>
	</v-content>
	<v-layout row justify-center>
		<v-dialog v-model="dialog" persistent max-width="290">
			<v-card>
				<v-card-title class="headline">Новый документ</v-card-title>
				<v-card-text>Создан новый документ "Реализация товаров и услуг". Создать документ "Расходный ордер"?</v-card-text>
				<v-card-actions>
					<v-spacer></v-spacer>
					<v-btn color="red darken-1" flat @click="dialog = false">Отложить</v-btn>
					<v-btn color="green darken-1" flat @click="dialog = false">Создать</v-btn>
				</v-card-actions>
			</v-card>
		</v-dialog>
	</v-layout>
</v-app>
</template>
<script>
	export default {
		data () {
			return {
				search: '',
				pagination: {},
				selected: [],
				headers: [
				{
					text: 'Дата',
					align: 'left',
					value: 'date'
				},
				{ text: 'Статус', value: 'status' },
				{ text: 'Описание', value: 'description' }
				],
				exchangehistory: [
				{
					date: '2019-04-05',
					status: 'Успех',
					description: ''
				},
				{
					date: '2019-04-01',
					status: 'Есть ошибки',
					description: 'Не найден файл обмена!'
				}
				],
				items: [
				{ 
					title: 'Новый документ "Расходный ордер"',
					datestamp: '25.01.19 13:07'
				},
				{ 
					title: 'Новый документ "Расходный ордер"',
					datestamp: '25.01.19 13:15'
				}
				],
				dialog: true
			}
		},
		computed: {
			pages () {
				if (this.pagination.rowsPerPage == null ||
					this.pagination.totalItems == null
					) return 0

					return Math.ceil(this.pagination.totalItems / this.pagination.rowsPerPage)
			}
		}
	}
</script>