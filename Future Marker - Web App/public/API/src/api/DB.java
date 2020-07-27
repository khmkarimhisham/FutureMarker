package api;

import java.sql.*;

public class DB {

    public static Statement SQLStmt() throws SQLException {
        Connection conn = DriverManager.getConnection("jdbc:mysql://localhost/Database_name?serverTimezone=UTC", "username", "password");
        Statement SQLStmt = conn.createStatement();
        return SQLStmt;
    }

}
