<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
<div id="app" class="container">
    <account-list :account="account"></account-list>
    <position-list :position="position"></position-list>
</div>

<template id='account-list-template'>
    <div class="row">
    <h2 class="text-center">资金状况</h2>
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th>当前余额</th>
            <th>可用金额</th>
            <th>资产总值</th>
            <th>证券市值</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>@{{ account.current_balance }}</td>
            <td>@{{ account.enable_balance }}</td>
            <td>@{{ account.asset_balance }}</td>
            <td>@{{ account.market_value }}</td>
        </tr>
        </tbody>
    </table>
    </div>
</template>

<template id='position-list-template'>
        <div class="row">
        <h2 class="text-center">持仓</h2>
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th>证券代码</th>
                <th>证券名</th>
                <th>证券市值</th>
                <th>摊薄成本价</th>
                <th>当前数量</th>
                <th>可卖数量</th>
                <th>摊薄浮动盈亏</th>
                <th>保本价</th>
                <th>最新价</th>
            </tr>
            </thead>
            <tbody>
            <tr v-if="existPosition">
                <td>@{{ position.stock_code }}</td>
                <td>@{{ position.stock_name }}</td>
                <td>@{{ position.market_value }}</td>
                <td>@{{ position.cost_price }}</td>
                <td>@{{ position.current_amount }}</td>
                <td>@{{ position.enable_amount }}</td>
                <td>@{{ position.income_balance }}</td>
                <td>@{{ position.keep_cost_price }}</td>
                <td>@{{ position.last_price }}</td>
            </tr>
            </tbody>
        </table>
        </div>
</template>

<script src="http://cdn.bootcss.com/vue/1.0.13/vue.js"></script>
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="http://cdn.bootcss.com/lodash.js/3.10.1/lodash.js"></script>
<script>
    Vue.component('account-list', {
        template: '#account-list-template',
        props: ['account']
    })

    Vue.component('position-list', {
        template: '#position-list-template',
        computed: {
            existPosition: function () {
                return this.position.length > 0 && this.position[0]['stock_code'] !== ''            
            }
        },
        props: ['position']
    })

    new Vue({
        el: '#app',
        data: {
            account: {},
            position: {}
        },
        ready: function () {
            this.getBalance()
            this.getPosition()
        },
        methods: {
            getJson: function (api, data) {
                setInterval(function () {
                    $.getJSON('/api/account/' + api, function(json, textStatus) {
                        data = json
                    })
                }, 1000)
            },
            getBalance: function () {
                var vm = this
                setInterval(function () {
                    $.getJSON('/api/account/balance', function(json, textStatus) {
                        vm.account = json[0]
                    }.bind(this))
                }, 1000)
            },
            getPosition: function () {
                this.getJson('position', this.position)
            }
        }
    })
</script>
</body>
</html>