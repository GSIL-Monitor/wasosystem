<template>
        <div>
        <DatePicker type="daterange" :options="options2"  :value="value2"  editable placement="bottom-end" name="select_date" placeholder="选择时间区间" style="width: 200px;display: inline-block"></DatePicker>
        </div>
</template>
<script>
    export default {
        props: ['defaultDate'],
        data () {
            return {
                value2: [new Date(), new Date()],
                options2: {
                    shortcuts: [
                        {
                            text: '今天',
                            value () {
                                const end = new Date();
                                const start = new Date();
//                                start.setTime(start.getTime() - 3600 * 1000 * 24 * 7);
                                return [start, end];
                            }
                        },
                        {
                            text: '7天',
                            value () {
                                const end = new Date();
                                const start = new Date();
                                start.setTime(start.getTime() - 3600 * 1000 * 24 * 7);
                                return [start, end];
                            }
                        },
                        {
                            text: '15天',
                            value () {
                                const end = new Date();
                                const start = new Date();
                                start.setTime(start.getTime() - 3600 * 1000 * 24 * 15);
                                return [start, end];
                            }
                        },
                        {
                            text: '30天',
                            value () {
                                const end = new Date();
                                const start = new Date();
                                start.setTime(start.getTime() - 3600 * 1000 * 24 * 30);
                                return [start, end];
                            }
                        },
                        {
                            text: '60天',
                            value () {
                                const end = new Date();
                                const start = new Date();
                                start.setTime(start.getTime() - 3600 * 1000 * 24 * 60);
                                return [start, end];
                            }
                        },
                        {
                            text: '90天',
                            value () {
                                const end = new Date();
                                const start = new Date();
                                start.setTime(start.getTime() - 3600 * 1000 * 24 * 90);
                                return [start, end];
                            }
                        },
                        {
                            text: '120天',
                            value () {
                                const end = new Date();
                                const start = new Date();
                                start.setTime(start.getTime() - 3600 * 1000 * 24 * 120);
                                return [start, end];
                            }
                        }
                    ]
                }
            }
        },mounted () {
          console.log("测试")
            this.value2=this.defaultDate;
          console.log(this.value2);
        }
    }
</script>
