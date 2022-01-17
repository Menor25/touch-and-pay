import Chart from "../../compnents/chart/Chart";
import FeaturedInfo from "../../compnents/featuredinfo/FeaturedInfo";
import "./home.css";
import { userData } from "../../dummyData";
import WidgetSm from "../../compnents/widgetSm/WidgetSm";
import WidgetLg from "../../compnents/widgetLg/WidgetLg";

export default function Home() {
    return (
        <div className="home">
            <FeaturedInfo/>
            <Chart data={userData} title="User Analytics" grid dataKey="Active Users"/>
            <div className="homeWidgets">
                <WidgetSm/>
                <WidgetLg/>
            </div>
        </div>
    )
}
