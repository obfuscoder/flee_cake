@Grapes([
        @GrabConfig(systemClassLoader = true),
        @Grab(group='com.h2database', module='h2', version='1.4.181'),
        @Grab(group='mysql', module='mysql-connector-java', version='5.1.32')
])
import groovy.sql.Sql

println "hello world"
for (arg in this.args ) {
    println "Argument: " + arg
}
