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
				<v-subheader>Выгрузка данных:</v-subheader>
				<v-radio-group v-model="radioGroup" row>
					<v-radio color="green"
					v-for="(value1, i) in ['Только новые данные', 'Все']"
					:key="i"
					:label="value1"
					:value="i"
					></v-radio>
				</v-radio-group>
				<v-divider></v-divider>
				<v-subheader>Загрузка данных:</v-subheader>
				<v-checkbox
				v-model="mode"
				color="green"
				label="Обновлять загруженные документы"
				></v-checkbox>
				<v-divider></v-divider>
				<v-subheader>Дополнительно:</v-subheader>
				<v-btn flat color="red">Очистить историю обмена</v-btn>
			</v-container>
		</v-content>
	</v-app>
</template>
<script>
	export default {
		data () {
			return {
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
				radioGroup: 0,
				mode: true
			}
		}
	}
</script>