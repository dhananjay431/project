module.exports = function(grunt) {
 grunt.initConfig({ 
		 uglify: {
			dist:{
			  files: {
				'dest/output.min.js': ['./src/*.js']
			  }
			}
		  }
  });
grunt.loadNpmTasks('grunt-contrib-uglify');
grunt.registerTask('default', ['uglify']);

};
/*
…or create a new repository on the command line
echo "# ng5" >> README.md
git init
git add README.md
git commit -m "first commit"
git remote add origin https://github.com/dhananjay431/ng5.git
git push -u origin master
…or push an existing repository from the command line

git remote add origin https://github.com/dhananjay431/ng5.git
git push -u origin master
*/