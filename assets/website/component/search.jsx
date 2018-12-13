// const wait_interval = 1000;

var Tingkat = React.createClass({
    getInitialState: function(){
        return{
            tingkat: ['ALL','SD','SMP','SMA']
        }
    },

    render() {
        return (
            <div className="col-lg-2 col-md-2 col-sm-2 col-12 d-flex align-items-center">
                <select id="tingkatSearch" onChange={this.handleTingkatChange}>
                    {
                        this.state.tingkat.map(data_tingkat =>{
                            return(
                                <option value={data_tingkat} key={data_tingkat}>{data_tingkat}</option>
                            )
                        })
                    }
                </select>
                <span className="divider"></span>
            </div>
        )
    },

    handleTingkatChange:function(e){
        this.props.changeTingkatText(e.target.value);
    },
});

var Provinsi = React.createClass({
    getInitialState: function(){
        return{
            provinsi: []
        }
    },

    componentDidMount()
    {
        var baseData = 'http://kes.co.id/dev/_andrew/schoolw/UserController/fillProvinsi';
        // var baseData = 'http://localhost/schoolp/UserController/fillProvinsi';
        var request = new Request(baseData);
        fetch(request)
        .then( res => res.json() )
        .then( (response) => {
            this.setState({provinsi:response})
        })
    },

    render() {
        return (
            <div className="col-lg-2 col-md-5 col-sm-5 col-12 d-flex align-items-center">
                <input list="provinsi" placeholder="Provinsi" id="tingkatProvinsi" onInput={this.handleProvinsiInput}/>
                    <datalist id="provinsi">
                        <option value="DKI JAKARTA"></option>
                        {
                        this.state.provinsi.map(data_provinsi =>{
                            return(
                            <option value={data_provinsi.nama_provinsi} key={data_provinsi.provinsiid}></option>
                            )
                        })
                        }
                    </datalist>
                <span className="divider"></span>
            </div>
            
        )
    },

    handleProvinsiInput:function(e){
        this.props.changeProvinsiText(e.target.value);
    },
    
});

var Kabupaten = React.createClass({
    getInitialState: function(){
        return{
            kabupaten: []
        }
    },

    componentDidUpdate(prevProps){
        if (this.props.provinsiName !== prevProps.provinsiName) {
            var getData = this.props.provinsiName;
            // var baseData = 'http://localhost/schoolp/UserController/fillKabupaten?provinsi=';
            var baseData = 'http://kes.co.id/dev/_andrew/schoolw/UserController/fillKabupaten?provinsi=';
            var request = new Request(baseData+getData);
            fetch(request)
            .then( res => res.json() )
            .then( (response) => {
                if(response.length == 0){
                    var newKabupaten= [{nama_kabupaten:'No Result',kabupatenid:'No Result'}]
                    this.setState({kabupaten:newKabupaten});
                }else{
                    this.setState({kabupaten:response})
                }
            })
        }
    },

    render() {
        return (
            <div className="col-lg-2 col-md-5 col-sm-5 col-12 d-flex align-items-center">
                <input list="kabupaten" placeholder="Kabupaten" id="tingkatKabupaten" onInput={this.handleKabupatenInput}/>
                    <datalist id="kabupaten">
                        {
                            this.state.kabupaten.map(data_kabupaten =>{
                                return(
                                <option value={data_kabupaten.nama_kabupaten} key={data_kabupaten.kabupatenid}></option>
                                )
                            })
                        }
                    </datalist>
                <span className="divider"></span>
            </div>
        )
    },

    handleKabupatenInput:function(e){
        this.props.changeKabupatenText(e.target.value);
    },

});

var Kecamatan = React.createClass({
    getInitialState: function(){
        return{
            kecamatan: []
        }
    },

    componentDidUpdate(prevProps){
        if (this.props.kabupatenName !== prevProps.kabupatenName) {
            var getData = this.props.kabupatenName;
            // var baseData = 'http://localhost/schoolp/UserController/fillKecamatan?kabupaten=';
            var baseData = 'http://kes.co.id/dev/_andrew/schoolw/UserController/fillKecamatan?kabupaten=';
            var request = new Request(baseData+getData);
            fetch(request)
            .then( res => res.json() )
            .then( (response) => {
                if(response.length == 0){
                    var newKecamatan= [{nama_kecamatan:'No Result',kecamatanid:'No Result'}]
                    this.setState({kecamatan:newKecamatan});
                }else{
                    this.setState({kecamatan:response})
                }
            })
        }
    },

    render() {
        return (
            <div className="col-lg-2 col-md-4 col-sm-6 col-12 d-flex align-items-center">
                <input list="kecamatan" placeholder="Kecamatan" id="tingkatKecamatan" onInput={this.handleKecamatanInput}/><i className="fa fa-map-marker in-icon"></i>
                    <datalist id="kecamatan">
                        {
                            this.state.kecamatan.map(data_kecamatan =>{
                                return(
                                <option value={data_kecamatan.nama_kecamatan} key={data_kecamatan.kecamatanid}></option>
                                )
                            })
                        }
                    </datalist>
            </div>
        )
    },

    handleKecamatanInput:function(e){
        this.props.changeKecamatanText(e.target.value);
    },

});

var Sekolah = React.createClass({
    getInitialState: function(){
        return{
            school_name: ''
        }
    },
    
    render() {
        return (
            <div className="col-lg-2 col-md-5 col-sm-6 col-12 d-flex align-items-center" >
                <input list="sekolah" onChange={this.handleSekolahInput} placeholder="Sekolah" id="tingkatNamaSekolah"/>
                <SekolahData 
                    {...this.props}
                    school_name = {this.state.school_name}
                />
                <i className="fa fa-search in-icon"></i>
            </div>
        )
    },
    
    handleSekolahInput:function(e){
        this.setState({school_name:e.target.value})
    },

});

var SekolahData = React.createClass({

    getInitialState: function(){
        return{
            schools: []
        }
    },

    componentDidUpdate(prevProps){
        if (this.props !== prevProps) {
            var tingkat = 'tingkat='+this.props.tingkat;
            var provinsi = '&provinsi='+this.props.provinsiName;
            var kabupaten = '&kabupaten='+this.props.kabupatenName;
            var kecamatan = '&kecamatan='+this.props.kecamatanName;
            var sekolah = '&sekolah='+this.props.school_name;
            // var baseData = 'http://localhost/schoolp/UserController/fillSekolah?';
            var baseData = 'http://kes.co.id/dev/_andrew/schoolw/UserController/fillSekolahStart?';
            var request = new Request(baseData+tingkat+provinsi+kabupaten+kecamatan+sekolah);
            fetch(request)
            .then( res => res.json() )
            .then( (response) => {
                if(response.length == 0){
                    var newSekolah= [{school_name:'No Result',schoolid:'No Result'}]
                    this.setState({schools:newSekolah});
                }else{
                    this.setState({schools:response})
                }
            })
        }
    },
  
    render() {
        return (
            <datalist id="sekolah">
                {
                    this.state.schools.map(data_sekolah =>{
                        return(
                        <option value={data_sekolah.school_name} key={data_sekolah.schoolid}></option>
                        )
                    })
                }
            </datalist>
        )
    }

});

var App = React.createClass({
    getInitialState: function(){
        return{
            tingkat: 'ALL',
            provinsiName: '',
            kabupatenName: '',
            kecamatanName: ''
        }
    },

    handleTingkatText: function(tName){
        this.setState({tingkat: tName});
    },

    handleProvinsiText: function(pName){
        this.setState({provinsiName: pName});
    },

    handleKabupatenText: function(kName){
        this.setState({kabupatenName: kName});
    },

    handleKecamatanText: function(eName){
        this.setState({kecamatanName: eName});
    },

    render() {
        return (
        <div className="container-fluid">
            <div className="row align-items-center justify-content-center">
                <div className="header-search-inside">	
                    <h3>Temukan sekolah terbaik untuk anak anda</h3>
                    <div className="row align-items-center justify-content-center header-search-input">
                        <Tingkat 
                        {...this.state}
                        changeTingkatText={this.handleTingkatText}
                        />
                        <Provinsi 
                        {...this.state}
                        changeProvinsiText={this.handleProvinsiText}
                        />
                        <Kabupaten
                        {...this.state}
                        changeKabupatenText={this.handleKabupatenText}
                        />
                        <Kecamatan
                        {...this.state}
                        changeKecamatanText={this.handleKecamatanText}
                        />
                        <Sekolah
                        {...this.state}
                        />
                        <div className="col-lg-2 col-md-3 col-12">
                            <button type="button" className="btn btn-block btn-info" id="but_search">Cari</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        )
    }
});

ReactDOM.render(<App />, document.getElementById('app'));
