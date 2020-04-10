package api;

import java.sql.*;

public class DB {

    public static Statement SQLStmt() throws SQLException {
        Connection conn = DriverManager.getConnection("jdbc:mysql://localhost/futuremarker?serverTimezone=UTC", "root", "");
        Statement SQLStmt = conn.createStatement();
        return SQLStmt;
    }

}
