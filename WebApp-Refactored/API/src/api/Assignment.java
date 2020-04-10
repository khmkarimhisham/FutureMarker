package api;

import java.util.ArrayList;

import java.sql.*;

public class Assignment {

    private static int Compilation_grade;
    private static int Style_grade;
    private static int Dynamic_test_grade;
    private static int Feature_test_grade;
    private static ArrayList<DynamicTest> dynamic_test_array = new ArrayList<DynamicTest>();
    private static ArrayList<FeatureTest> feature_test_array = new ArrayList<FeatureTest>();

    public static void setAssignment() {
        try {
            ResultSet result = DB.SQLStmt().executeQuery("SELECT `Compilation_grade`, `Style_grade`, `Dynamic_test_grade`, `Feature_test_grade` FROM `assignment` WHERE `Assignment_ID` = " + DoingAssignment.getAssignment_ID());
            if (result.next()) {
                Assignment.Compilation_grade = Integer.parseInt(result.getString("Compilation_grade"));
                Assignment.Style_grade = Integer.parseInt(result.getString("Style_grade"));
                Assignment.Dynamic_test_grade = Integer.parseInt(result.getString("Dynamic_test_grade"));
                Assignment.Feature_test_grade = Integer.parseInt(result.getString("Feature_test_grade"));
            }

            ResultSet result2 = DB.SQLStmt().executeQuery("SELECT * FROM `dynamic_test` WHERE `Assignment_ID` = " + DoingAssignment.getAssignment_ID());
            while (result2.next()) {
                getDynamic_test_array().add(new DynamicTest(result2.getString("Input"), result2.getString("output"), "1".equals(result2.getString("Hidden"))));
            }

            ResultSet result3 = DB.SQLStmt().executeQuery("SELECT * FROM `feature_test` WHERE `Assignment_ID` = " + DoingAssignment.getAssignment_ID());
            while (result3.next()) {
                getFeature_test_array().add(new FeatureTest(result3.getString("Test_name"), result3.getString("regex"), Integer.parseInt(result3.getString("Repetition_counter"))));
            }
        } catch (SQLException exc) {
        }
    }

    public static int getCompilation_grade() {
        return Compilation_grade;
    }

    public static int getStyle_grade() {
        return Style_grade;
    }

    public static int getDynamic_test_grade() {
        return Dynamic_test_grade;
    }

    public static int getFeature_test_grade() {
        return Feature_test_grade;
    }

    /**
     * @return the dynamic_test_array
     */
    public static ArrayList<DynamicTest> getDynamic_test_array() {
        return dynamic_test_array;
    }

    /**
     * @return the feature_test_array
     */
    public static ArrayList<FeatureTest> getFeature_test_array() {
        return feature_test_array;
    }
}
