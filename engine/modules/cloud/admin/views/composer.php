<div class="panel panel-default">
	<div class="panel-heading">
		DLE-Composer
	</div>
	<div class="panel-body">
				<h3>Commands:</h3>
                <div class="form-inline">
                    <button id="self-update" onclick="del()" class="btn btn-success disabled">Update Composer</button><br /><br />
                    <input type="text" id="path" style="width:300px;" class="form-control disabled" placeholder="absolute path to project directory"/>
                    <button id="install" onclick="call('install')" class="btn btn-success disabled">install</button>
                    <button id="update" onclick="call('update')" class="btn btn-success disabled">update</button>
                    <button id="update" onclick="call('dump-autoload')" class="btn btn-success disabled">dump-autoload</button>
                </div>
                <h3>Console Output:</h3>
                <pre id="output" class="well"></pre>
	</div>
</div>