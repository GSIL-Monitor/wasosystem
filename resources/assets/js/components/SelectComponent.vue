<template>
    <div>
        <Row>
            <Col span="12">
            <Select v-model="good_id"  :name="names" clearable filterable transfer >
                <Option v-for="(item,index) in goodList" :value="item.id ? item.id :index"
                        :key="item.id ? item.id :index">
                    {{item.id ? item.id :index}}----{{item.name ? item.name : item}}
                </Option>
            </Select>
            </Col>
        </Row>
        <!--<input type="text" :value="good_id">-->
    </div>
</template>
<script>
    export default {
        props: ['goodList','goodIds','names'],
        data() {
            return {
                good_id:""
            }
        },
        methods: {
        },
        mounted() {
            this.good_id=this.goodIds;

        },
    }
</script>