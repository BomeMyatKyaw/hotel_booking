<!DOCTYPE html>
<html>
	<head>
		<title>Tabs</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<style>
            body{
                height: 100vh;
            
                display: grid;
            }
            
            .container{
                width: 90%;

                padding-left: 90px;
            }
            
            .nav{
                background-color: #f1f1f1;
                border: 1px solid #ccc;
            
                display: flex;
            
                padding: 0;
                margin: 0;
            }
            
            .nav .nav-item{
                list-style-type: none;
            }
            
            .nav .tablinks{
                background-color: inherit;
                font-size: 17px;
                border: none;
                outline: none;
                cursor: pointer;
            
                padding: 14px 16px;
            
                transition: background-color 0.3s;
            }
            
            .nav .tablinks:hover{
                background-color: #ccc;
            }
            
            .nav .tablinks.active,.tab-content{
                background-color: #ccc;
            }
            
            .tab-panel{
                background-color: 1px solid #bbb;
                border-top: none;
            
                padding: 6px 12px;
            
                display: none;
            }
            
            .btn-close{
                font-size: 28px;
                cursor: pointer;
            
                float: right;
            }
            
            .btn-close:hover{
                color: red;
            }
        </style>
	</head>

	<body>

        <div class="container">

            <h2>Tabs</h2>

            <ul class="nav">
                <li class="nav-item">
                    <button type="button" id="autoclick" class="tablinks active" onclick="gettab(event,'home')">Home</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="tablinks" onclick="gettab(event,'profile')">Profile</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="tablinks" onclick="gettab(event,'contact')">Contact</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="tablinks" onclick="gettab(event,'settings')">Settings</button>
                </li>
            </ul>

            <div class="tab-content">

                <div id="home" class="tab-panel">
                    <span class="btn-close">&times;</span>
                    <h3>This is Home information</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>

                <div id="profile" class="tab-panel">
                    <span class="btn-close">&times;</span>
                    <h3>This is Profile information</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>

                <div id="contact" class="tab-panel">
                    <span class="btn-close">&times;</span>
                    <h3>This is Contact information</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>

                <div id="settings" class="tab-panel">
                    <span class="btn-close">&times;</span>
                    <h3>This is Settings information</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>

            </div>
            
        </div>

		<script>

            let gettablinks = document.getElementsByClassName('tablinks'),
                gettabpanels = document.getElementsByClassName('tab-panel'),
                getbtnclose = document.querySelectorAll('.btn-close');

            let tabpanels = Array.from(gettabpanels);

            function gettab(evn,link){

                // Remove Active
                for(var x=0; x < gettablinks.length; x++){

                    //remove active
                    gettablinks[x].className = gettablinks[x].className.replace(' active','');

                    // hide tabpanelbox from btn-close
                    getbtnclose[x].addEventListener('click',function(){
                        this.parentElements.style.display = "none";
                    });

                }

                // Add active
                evn.target.classList.add('active');

                // Hide Panel
                tabpanels.forEach(function(tabpanel){
                    tabpanel.style.display = "none";
                });

                // Show Panel
                document.getElementById(link).style.display = "block";

            }
            document.getElementById('autoclick').click();

        </script>
	</body>
</html>